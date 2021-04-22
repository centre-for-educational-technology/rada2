<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressGeocode extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_data' => 'array',
    ];

    protected $fillable = [
        'latitude',
        'longitude',
        'hash',
        'additional_data',
    ];

    /**
     * Returns additional data, if one is present.
     *
     * @return array|null
     */
    public function getAdditionalData(): ?array
    {
        return $this->additional_data;
    }

    /**
     * Returns a latitude.
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns a longitude.
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Returns a keyed array with latitude and longitude data.
     *
     * @return float[]
     */
    public function getLatLng(): array
    {
        return [
            'lat' => $this->getLatitude(),
            'lng' => $this->getLongitude(),
        ];
    }
}
