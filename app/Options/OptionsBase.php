<?php

namespace App\Options;

use App\Options\Interfaces\Options as OptionsInterface;

class OptionsBase implements OptionsInterface
{
    /**
     * Available options
     * @var array
     */
    protected $options = [];

    /**
     * Returns all available options.
     * @return array Defined options.
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * Returns value for the option key provided. Defaults to the provided key
     * if value for one does not exist.
     * @param  mixed $key Option identifier
     * @return mixed      Option value or provided identifier
     */
    public function value($key)
    {
        $options = $this->options();

        if ( array_key_exists($key, $options) ) {
            return $options[$key];
        }

        return $key;
    }
}
