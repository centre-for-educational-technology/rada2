<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\GeocodingService;
use App\Services\MuinasService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class BuildExternalImageDataGeocodeIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:external:image:data:geocode:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collects unique addresses for external image resources without positioning data. Tries to geocode these addresses and stores positions in local table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GeocodingService $geocodingService, MuinasService $muinasService)
    {
        $uniqueAddresses = new Collection();
        $query = ExternalImageResource::query();
        $progressBar = $this->output->createProgressBar((clone $query)->whereNull('latitude')->whereNull('longitude')->where('provider', '=', 'muinas')->count());

        $this->line('Building unique address index where geolocation data is missing.');

        (clone $query)->chunk(500, function($resources) use ($uniqueAddresses, $progressBar, $geocodingService, $muinasService) {
            foreach ($resources as $resource) {
                if ($resource->provider !== 'muinas') {
                    continue;
                }

                if ($resource->hasGeoLocation()) {
                    continue;
                }

                $parts = $muinasService->getAddressParts($resource);

                $addressHash = $geocodingService->hashAddressParts($parts);

                if (!$uniqueAddresses->has($addressHash)) {
                    $uniqueAddresses->put($addressHash, $parts);
                }

                $progressBar->advance();
            }
        });

        $progressBar->finish();

        $this->newLine();
        $this->line(sprintf('Built index contains %d unique addresses.', $uniqueAddresses->count()));

        if (!$this->confirm(sprintf('Would you like to try to geocode these %d addresses?', $uniqueAddresses->count()))) {
            return 0;
        }

        $fp = fopen('results.csv', 'w+');

        $geolocationProgressBar = $this->output->createProgressBar($uniqueAddresses->count());

        $successfulPositions = 0;

        $uniqueAddresses->each(function($addressParts) use ($fp, $geocodingService, $geolocationProgressBar, &$successfulPositions) {
            $tmp['address'] = $geocodingService->joinAddressParts($addressParts);

            try {
                $addressGeolocation = $geocodingService->getLocalOrGeocode($addressParts);
                $tmp['status'] = 'OK';
                $successfulPositions++;
            } catch (\Exception $e) {
                $tmp['status'] = $e->getMessage();
            }

            fputcsv($fp, $tmp);
            $geolocationProgressBar->advance();
        });

        fclose($fp);
        $geolocationProgressBar->finish();

        $this->newLine();
        $this->line(sprintf('%d addresses with positions out of total %d. Please see \'results.csv\' for more details.', $successfulPositions, $uniqueAddresses->count(), $successfulPositions));

        return 0;
    }
}
