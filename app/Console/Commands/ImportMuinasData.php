<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\MuinasService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportMuinasData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:muinas:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import image data from register.muinas.ee';

    /**
     * Muinas service instance.
     *
     * @var MuinasService
     */
    protected $muinasService;

    /**
     * Create a new command instance.
     *
     * @param MuinasService $muinasService
     */
    public function __construct(MuinasService $muinasService)
    {
        parent::__construct();

        $this->muinasService = $muinasService;
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
            if ($this->confirm('Would you like to delete already existing register.muinas.ee data?', true)) {
                DB::delete(sprintf("DELETE FROM %s WHERE provider = '%s'", (new ExternalImageResource())->getTable(), 'muinas'));
            }
        }

        $handledCount = 0;
        $importedImagesCount = 0;
        $limit = 1000;
        $offset = 0;

        while($data = $this->loadPhotoLibraryData($limit, $offset)) {
            $dataCount = count($data);
            $offset += $dataCount;
            $handledCount += $dataCount;

            $this->line(sprintf('Processing %d items, with total processed of %d.', $dataCount, $handledCount));

            $this->withProgressBar($data, function($item) use (&$importedImagesCount) {
                $itemData = $this->muinasService->getPhotoJson((int)$item['id']);
                $importedImagesCount += count(ExternalImageResource::createFromMuinas($itemData));
            });
            $this->newLine();
        }

        $this->line(sprintf('Processed %d total items and imported %d images.', $handledCount, $importedImagesCount));

        return 0;
    }

    private function loadPhotoLibraryData(int $limit, int $offset): array
    {
        $photoLibraryApiUrl = $this->muinasService::photosApiUrl();

        $response = Http::get($photoLibraryApiUrl, [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if (!$response->ok()) {
            throw new \Exception('Photos library data not loaded');
        }

        return $response->json();
    }
}
