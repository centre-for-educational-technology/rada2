<?php

namespace App\Options;

class LanguageOptions
{
    public function options()
    {
        return [
            'en' => trans('general.languages.en'),
            'et' => trans('general.languages.et'),
            'ru' => trans('general.languages.ru'),
            'fi' => trans('general.languages.fi'),
            'swe' => trans('general.languages.swe'),
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
