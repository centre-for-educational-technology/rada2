<?php

namespace App\Options;

class DiscountVoucherStatusOptions extends OptionsBase
{
    /**
     * Create instance and set available options
     */
    public function __construct()
    {
        $this->options = [
            0 => trans('general.discount-voucher-status.inactive'),
            1 => trans('general.discount-voucher-status.active'),
        ];
    }
}
