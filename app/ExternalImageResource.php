<?php

namespace App;

use App\Services\AjapaikService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalImageResource extends Model
{
    use HasFactory;

    protected $casts = [
        'external_data' => 'array',
    ];

    protected $fillable = [
        'latitude',
        'longitude',
        'title',
        'description',
        'provider',
        'image_url',
        'page_url',
        'external_data',
    ];

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
                'page_url' => "https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id={$data['id']}&page=1&filter%5Bcmtype%5D=46",
                'external_data' => $data,
            ]);

            $resources[] = $resource;
        }

        return $resources;
    }

    /**
     * Processes an image library item data from ajapaik.ee and creates models for all images present.
     *
     * @param array $data
     *
     * @return ExternalImageResource
     */
    public static function createFromAjapaik(array $data): ExternalImageResource
    {
        $ajapaikService = app(AjapaikService::class);

        return self::create([
            'latitude' => $data['lat'],
            'longitude' => $data['lon'],
            'title' => $ajapaikService->getResponseTitle($data),
            'description' => $ajapaikService->getResponseDescription($data),
            'provider' => 'ajapaik',
            'image_url' => $data['image'],
            'page_url' => "https://ajapaik.ee/photo/{$data['id']}",
            'external_data' => $data,
        ]);
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

    /**
     * Returns a latitude.
     *
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * Returns a longitude.
     *
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * Determines if external image resource has geolocation set.
     *
     * @return bool
     */
    public function hasGeoLocation(): bool
    {
        return $this->getLatitude() && $this->getLongitude();
    }
}
