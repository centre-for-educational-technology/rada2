<?php

namespace App\Options;

class ZooGeolocationOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            1 => [
                'lat' => 59.3270,
                'lng' => 18.1037,
            ],
            2 => [
                'lat' => 60.1750,
                'lng' => 24.9861,
            ],
            3 => [
                'lat' => 59.4259,
                'lng' => 24.6595,
            ]
        ];
    }

    /**
     * Return geolocation option value or throw an exception
     * @param  mixed $key Option key
     * @return array      Geolocation value
     */
    public function value($key)
    {
        $value = parent::value($key);

        if ( $value === $key )
        {
            throw new \Exception('No Geolocation for key: ' . (string)$key);
        }

        return $value;
    }
}
