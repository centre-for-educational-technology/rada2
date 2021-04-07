<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalImageResource extends Model
{
    protected $casts = [
        'external_data' => 'array',
    ];

    protected $fillable = [
        'title',
        'description',
        'provider',
        'image_url',
        'external_data',
    ];

    use HasFactory;

    /**
     * Processes an image library item data from register.muinas.ee and creates models for all images present.
     *
     * @param array $data Single item data from API response
     *
     * @return array An array of ExternalImageResource objects
     */
    public static function createFromMuinas(array $data): array
    {
        $resources = [];

        foreach($data['images'] as $image) {
            $resource = self::create([
                'title' => $data['title'],
                'description' => '',
                'provider' => 'muinas',
                'image_url' => $image['file'],
                'external_data' => $data,
            ]);

            $resources[] = $resource;
        }

        return $resources;
    }

    /**
     * Returns full URL of an external image.
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->image_url;
    }
}
