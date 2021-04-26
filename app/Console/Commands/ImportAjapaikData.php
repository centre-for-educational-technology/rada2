<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\AjapaikService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportAjapaikData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ajapaik:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import image data from ajapaik.ee';

    /**
     * ajapaik service instance.
     *
     * @var AjapaikService
     */
    protected $ajapaikService;

    /**
     * Create a new command instance.
     *
     * @param AjapaikService $ajapaikService
     */
    public function __construct(AjapaikService $ajapaikService)
    {
        parent::__construct();

        $this->ajapaikService = $ajapaikService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('Beginning data import. This is a long running process, so please be patient.');
        $this->newLine(1);

        if ($this->confirm('Would you like to remove existing data by truncating the table?')) {
            DB::table((new ExternalImageResource())->getTable())->truncate();
        } else {
            if ($this->confirm('Would you like to delete already existing ajapaik.ee data?')) {
                DB::delete(sprintf("DELETE FROM %s WHERE provider = '%s'", (new ExternalImageResource())->getTable(), 'ajapaik'));
            }
        }

        $handledCount = 0;
        $importedImagesCount = 0;
        $nextUrl = null;

        while($response = $this->loadPhotoLibraryData($nextUrl)) {
            if (!$response['next']) {
                break;
            }

            $nextUrl = $response['next'];

            $dataCount = count($response['results']);
            $handledCount += $dataCount;

            $this->line(sprintf('Processing %d items, with total processed of %d.', $dataCount, $handledCount));

            $this->withProgressBar($response['results'], function($item) use (&$importedImagesCount) {
                ExternalImageResource::createFromAjapaik($item);
                $importedImagesCount++;
            });
            $this->newLine();
        }

        $this->line(sprintf('Processed %d total items and imported %d images.', $handledCount, $importedImagesCount));

        return 0;
    }

    private function loadPhotoLibraryData(string $nextUrl = null): array
    {
        if ($nextUrl) {
            $response = Http::retry(5, 500)->get($nextUrl);
        } else {
            $response = Http::retry(5, 500)->get($this->ajapaikService::photosApiUrl(), [
                'limit' => 1000,
            ]);
        }

        if (!$response->ok()) {
            throw new \Exception('Photos library data not loaded');
        }

        return $response->json();
    }
}
