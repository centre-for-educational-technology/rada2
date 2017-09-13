<?php

namespace App\Options;

class DifficultyLevelOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            1 => trans('general.difficulty-level.easy'),
            2 => trans('general.difficulty-level.medium'),
            3 => trans('general.difficulty-level.hard'),
        ];
    }
}
