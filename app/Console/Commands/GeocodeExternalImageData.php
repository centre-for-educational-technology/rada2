<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\GeocodingService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GeocodeExternalImageData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geocode:external:image:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all the external images which do not yet have positioning data, tries to add that based on local positioning data that is available.';

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
    public function handle(GeocodingService $geocodingService)
    {
        $query = ExternalImageResource::query()->whereNull('latitude')->whereNull('longitude');
        $progressBar = $this->output->createProgressBar((clone $query)->count());

        $this->line('Enriching image data with geographical positions.');
        $this->warn('Please note that only locally stored locations are being used!');

        $tableName = (new ExternalImageResource())->getTable();
        $successCount = 0;
        $updateQueries = '';

        (clone $query)->chunk(500, function ($resources) use ($progressBar, $geocodingService, &$successCount, $tableName, &$updateQueries) {
            foreach ($resources as $resource) {
                $parts = $resource->getAddressParts();

                if (empty($parts)) {
                    $progressBar->advance();
                    continue;
                }

                $addressGeolocation = $geocodingService->getAddressGeocode($parts);

                if ($addressGeolocation) {
                    $updateQueries .= sprintf("UPDATE %s SET latitude = %F, longitude = %F WHERE id = %d;", $tableName, $addressGeolocation->getLatitude(), $addressGeolocation->getLongitude(), $resource->id);
                    $successCount++;
                }

                $progressBar->advance();
            }
        });

        $progressBar->finish();

        if ($updateQueries) {
            $this->newLine();
            $this->line('Running update queries, please wait.');
            DB::unprepared($updateQueries);
        }

        $this->newLine();
        $this->line(sprintf('Added positioning data to %d external image resources.', $successCount));

        return 0;
    }
}
