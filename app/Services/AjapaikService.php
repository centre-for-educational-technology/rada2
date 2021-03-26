<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Exceptions\PhotoDataNotLoaded;

class AjapaikService
{
    CONST OPEN_DATA_BASE_URL = 'https://opendata.ajapaik.ee';

    public static function photosApiUrl(): string
    {
        return self::OPEN_DATA_BASE_URL . '/photos';
    }

    /**
     * Loads and returns a photo data from service.
     *
     * @param int $id Photo unique identifier
     *
     * @return array Photo JSON data loaded from an API
     *
     * @throws PhotoDataNotLoaded
     */
    public function getPhotoJson(int $id): array
    {
        $response = Http::get(self::photosApiUrl() . '/' . $id);

        if (!$response->ok()) {
            throw new PhotoDataNotLoaded($response->getReasonPhrase(), $response->status());
        }

        return $response->json();
    }
}