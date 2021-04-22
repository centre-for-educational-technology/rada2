<?php


namespace App\Services;


use App\AddressGeocode;
use Illuminate\Support\Facades\Http;

class GeocodingService
{
    /**
     * Returns API KEY for google maps service.
     *
     * @return string
     */
    public function apiKey(): string
    {
        return config('services.maps.google.api_key');
    }

    /**
     * Makes a geocoding request to an external service.
     * Throws exceptions if request fails or there are no results.
     *
     * @param array $parts Address parts
     *
     * @return array
     *
     * @throws \Exception
     */
    public function geocode(array $parts): array
    {
        $address = $this->joinAddressParts($parts);

        try {
            $httpResponse = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $address,
                'key' => $this->apiKey(),
            ]);
        } catch (\Exception $e) {
            throw $e;
        }

        $data = $httpResponse->json();

        switch($data['status']) {
            case 'OK':
                $response = $data;
                break;
            case 'ZERO_RESULTS':
            case 'OVER_DAILY_LIMIT':
            case 'OVER_QUERY_LIMIT':
            case 'REQUEST_DENIED':
            case 'INVALID_REQUEST':
            case 'UNKNOWN_ERROR':
                throw new \Exception($data['status']);
                break;
            default:
                throw new \Exception('Unknown response status!');

        }

        return $response;
    }

    /**
     * Tries to fetch local geolocation for an address or make an API request to an external service.
     * Throw an exception if an external geocode request fails.
     *
     * @param array $parts Address parts
     *
     * @return AddressGeocode|null
     *
     * @throws \Exception
     */
    public function getLocalOrGeocode(array $parts): ?AddressGeocode
    {
        $addressGeocode = $this->getAddressGeocode($parts);

        if ($addressGeocode) {
            return $addressGeocode;
        }

        $geocodingResponse = $this->geocode($parts);

        return AddressGeocode::create([
            'latitude' => $geocodingResponse['results'][0]['geometry']['location']['lat'],
            'longitude' => $geocodingResponse['results'][0]['geometry']['location']['lng'],
            'hash' => $this->hashAddressParts($parts),
            'additional_data' => [
                'geocoding_response' => $geocodingResponse,
                'address_parts' => $parts,
            ],
        ]);
    }

    /**
     * Returns an address build from parts provided.
     *
     * @param array $parts Address parts
     *
     * @return string
     */
    public function joinAddressParts(array $parts): string
    {
        return join(', ', $parts);
    }

    /**
     * Returns a unique hash for an address.
     *
     * @param string $address Address text
     *
     * @return string
     */
    public function hashAddress(string $address): string
    {
        return hash('sha256', $address, false);
    }

    /**
     * Returns a unique hash for an address parts.
     *
     * @param array $parts Address parts
     *
     * @return string
     */
    public function hashAddressParts(array $parts): string
    {
        return $this->hashAddress($this->joinAddressParts($parts));
    }

    /**
     * Tries to fetch geographic position for an address from a local database.
     *
     * @param array $parts Address parts
     *
     * @return AddressGeocode|null
     */
    public function getAddressGeocode(array $parts): ?AddressGeocode
    {
        return AddressGeocode::where('hash', '=', $this->hashAddressParts($parts))->first();
    }
}