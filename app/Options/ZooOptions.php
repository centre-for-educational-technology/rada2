<?php

namespace App\Options;

class ZooOptions
{
    public function options()
    {
        return [
            1 => trans('general.zoos.skansen'),
            2 => trans('general.zoos.korkeasaari'),
            3 => trans('general.zoos.tallinn'),
        ];
    }

    public function value($id)
    {
        $options = $this->options();

        if ( array_key_exists($id, $options) ) {
            return $options[$id];
        }

        return $id;
    }
}
