<?php
/**
 * Created by PhpStorm.
 * Date: 3.07.19
 * Time: 13:07
 */

namespace App\Options;


class AgeOfParticipantsOptions extends OptionsBase
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
            '4-6',
            '7-9',
            '10-12',
            '13-15',
            '16-18',
            '18+'
        ];
    }
}