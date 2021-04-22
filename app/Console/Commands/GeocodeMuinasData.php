<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\GeocodingService;
use App\Services\MuinasService;
use Illuminate\Console\Command;

class GeocodeMuinasData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geocode:muinas:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all the external images from register.muinas.ee which do not yet have positioning data tries to add that data based on local positioning data.';

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
        $query = ExternalImageResource::query();
        $progressBar = $this->output->createProgressBar((clone $query)->whereNull('latitude')->whereNull('longitude')->where('provider', '=', 'muinas')->count());

        $this->line('Enriching image data from register.muinas.ee with geographical positions.');
        $this->warn('Please note that only locally stored locations are being used!');

        $successCount = 0;

        (clone $query)->chunk(500, function($resources) use ($progressBar, $geocodingService, $muinasService, &$successCount) {
            foreach ($resources as $resource) {
                if ($resource->provider !== 'muinas') {
                    continue;
                }

                if ($resource->hasGeoLocation()) {
                    continue;
                }

                $addressGeolocation = $geocodingService->getAddressGeocode($muinasService->getAddressParts($resource));

                if ($addressGeolocation) {
                    $resource->latitude = $addressGeolocation->getLatitude();
                    $resource->longitude = $addressGeolocation->getLongitude();
                    $resource->save();
                    $successCount++;
                }

                $progressBar->advance();
            }
        });

        $progressBar->finish();

        $this->newLine();
        $this->line(sprintf('Added positioning data to %d external image resources.', $successCount));

        return 0;
    }
}
