<?php

namespace App\Options;

class ZooGeolocationOptions
{
    public function options()
    {
        return [
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

    public function value($id)
    {
        $options = $this->options();

        if ( array_key_exists($id, $options) ) {
            return $options[$id];
        }

        throw \Exception('No Zoo Geolocation for key: ' . (string)$id);
    }
}
