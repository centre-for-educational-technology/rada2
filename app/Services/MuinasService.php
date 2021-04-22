<?php

namespace App\Services;

use App\ExternalImageResource;
use App\Services\Exceptions\PhotoDataNotLoaded;
use Illuminate\Support\Facades\Http;

class MuinasService
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
        $response = Http::retry(5, 500)->get(self::photoApiUrl($id));

        if (!$response->ok()) {
            throw new PhotoDataNotLoaded($response->getReasonPhrase(), $response->status());
        }

        return $response->json();
    }

    /**
     * Builds and returns address parts for an existing external image resource.
     * Country will be added to the bottom of an array.
     *
     * @param ExternalImageResource $resource
     *
     * @return array
     */
    public function getAddressParts(ExternalImageResource &$resource): array
    {
        if ($resource->external_data['address']) {
            $parts['address'] = trim($resource->external_data['address']);
        }
        if ($resource->external_data['parish']) {
            $parts['parish'] = trim($resource->external_data['parish']);
        }
        if ($resource->external_data['county']) {
            $parts['county'] = trim($resource->external_data['county']);
        }

        $parts['country'] = 'Eesti';

        return $parts;
    }
}