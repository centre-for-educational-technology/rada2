<?php

namespace App\Services;

use App\Services\Exceptions\PhotoDataNotLoaded;
use Illuminate\Support\Facades\Http;

class CulturalMonumentsService
{
    CONST OPEN_DATA_BASE_URL = 'https://register.muinas.ee/rest/v1';

    public static function photosApiUrl(): string
    {
        return self::OPEN_DATA_BASE_URL . '/photolibrarys';
    }

    public static function photoApiUrl(int $id): string
    {
        return self::photosApiUrl() . '/' . $id;
    }

    /**
     * Loads and returns a photo data from service.
     *
     * @param int $id Photo library object unique identifier
     *
     * @return array Photo JSON data loaded from an API
     *
     * @throws PhotoDataNotLoaded
     */
    public function getPhotoJson(int $id): array
    {
        // TODO We might need two different methods for call with retries and without them
        $response = Http::retry(5, 500)->get(self::photoApiUrl($id));

        if (!$response->ok()) {
            throw new PhotoDataNotLoaded($response->getReasonPhrase(), $response->status());
        }

        return $response->json();
    }
}