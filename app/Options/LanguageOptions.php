<?php

namespace App\Options;

class LanguageOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->initOptions();
    }

    /**
     * Initializes and sets options data.
     * Could be useful in case the language changes.
     */
    public function initOptions()
    {
        $this->options = [
            'en' => trans('general.languages.en'),
            'et' => trans('general.languages.et'),
//            'ru' => trans('general.languages.ru'),
//            'fi' => trans('general.languages.fi'),
//            'sv' => trans('general.languages.sv'),
        ];
    }
}
