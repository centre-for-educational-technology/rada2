<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\DiscountVoucher;

class StoreDiscountVoucher extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $voucher = $this->route('voucher');

        if ( $voucher ) {
            return $voucher && $this->user()->can('update', $voucher);
        } else {
            return $this->user()->can('create', DiscountVoucher::class);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $voucher = $this->route('voucher');

        return [
            'title' => 'required|max:255',
            'duration' => 'required|integer|min:0',
            'status' => 'required|integer|in:0,1',
            'image' => (!$voucher) ? 'required|image|mimes:jpeg,jpg,png' : 'image|mimes:jpeg,jpg,png',
        ];
    }
}
