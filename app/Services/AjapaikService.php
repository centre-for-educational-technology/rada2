<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Exceptions\PhotoDataNotLoaded;
use Illuminate\Support\Str;

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

    /**
     * Extracts and returns title from a service response
     *
     * @param array $data Service response
     *
     * @return string
     */
    public function getResponseTitle(array &$data): string
    {
        if (isset($data['title']) && $data['title']) {
            return $data['title'];
        }

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'title_') && $value) {
                return $value;
            }
        }

        return '';
    }

    /**
     * Extracts and returns description from a service response
     *
     * @param array $data Service response
     *
     * @return string
     */
    public function getResponseDescription(array &$data): string
    {
        if (isset($data['description']) && $data['description']) {
            return $data['description'];
        }

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, 'description_') && $value && $key !== 'description_original_language') {
                return $value;
            }
        }

        return '';
    }

    /**
     * Extracts all the data that should be used for searches, includes titles and descriptions
     *
     * @param array $data Service response
     *
     * @return array
     */
    public function getSearchableTextData(array &$data): array
    {
        $parts = [];

        if (isset($data['title']) && $data['title']) {
            $parts[] = $data['title'];
        }

        if (isset($data['description']) && $data['description']) {
            $parts[] = $data['description'];
        }

        foreach ($data as $key => $value) {
            if (Str::startsWith($key, ['title_', 'description_']) && $value && $key !== 'description_original_language') {
                $parts[] = $value;
            }
        }

        return $parts;
    }

    /**
     * Extracts all the data that should be used for searches and returns it as a string separated by newlines, includes titles and descriptions
     *
     * @param array $data Service response
     *
     * @return string
     */
    public function getSearchableTextString(array &$data): string
    {
        return join('\n', $this->getSearchableTextData($data));
    }
}