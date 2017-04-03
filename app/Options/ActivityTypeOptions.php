<?php

namespace App\Options;

class ActivityTypeOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            1 => trans('general.activity-type.collecting-cards'),
            2 => trans('general.activity-type.treasure-hunt'),
        ];
    }
}
