<?php

namespace App\Options;

class ActivityTypeOptions
{
    public function options()
    {
        return [
            1 => trans('general.activity-type.collecting-cards'),
            2 => trans('general.activity-type.treasure-hunt'),
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
