<?php

namespace App\Options;

class LanguageOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            'en' => trans('general.languages.en'),
            'et' => trans('general.languages.et'),
            'ru' => trans('general.languages.ru'),
            'fi' => trans('general.languages.fi'),
            'swe' => trans('general.languages.swe'),
        ];
    }
}
