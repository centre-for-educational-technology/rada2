<?php

namespace App\Console\Commands;

use App\ExternalImageResource;
use App\Services\CulturalMonumentsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportCulturalMonumentsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cultural:monuments:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import cultural monuments data';

    /**
     * Cultural monuments service instance.
     *
     * @var CulturalMonumentsService
     */
    protected $culturalMonumentsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CulturalMonumentsService $culturalMonumentsService)
    {
        parent::__construct();

        $this->culturalMonumentsService = $culturalMonumentsService;
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

        $handledCount = 0;
        $importedImagesCount = 0;
        $limit = 1000;
        $offset = 0;

        $data = $this->loadPhotoLibraryData(1000, 0);

        while($data = $this->loadPhotoLibraryData($limit, $offset)) {
            $dataCount = count($data);
            $offset += $dataCount;
            $handledCount += $dataCount;

            $this->line(sprintf('Processing %d items, with total processed of %d.', $dataCount, $handledCount));

            $this->withProgressBar($data, function($item) use (&$importedImagesCount) {
                $itemData = $this->culturalMonumentsService->getPhotoJson((int)$item['id']);
                $importedImagesCount = count(ExternalImageResource::createFromCulturalMonument($itemData));
            });
            $this->newLine();
        }

        $this->line(sprintf('Processed %d total items and imported %d images.', $handledCount, $importedImagesCount));

        return 0;
    }

    private function loadPhotoLibraryData(int $limit, int $offset): array
    {
        $photoLibraryApiUrl = $this->culturalMonumentsService::photosApiUrl();

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
