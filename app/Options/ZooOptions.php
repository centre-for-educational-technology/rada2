<?php

namespace App\Options;

class ZooOptions extends OptionsBase
{

    const DEFAULT_OPTION = 3;

    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            1 => trans('general.zoos.skansen'),
            2 => trans('general.zoos.korkeasaari'),
            3 => trans('general.zoos.tallinn'),
        ];
    }
}
