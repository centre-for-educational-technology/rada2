<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Activity;

use App\Options\LanguageOptions;

class StoreActivity extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $activity = $this->route('activity');

        if ( $activity ) {
            return $activity && $this->user()->can('update', $activity);
        } else {
            return $this->user()->can('create', Activity::class);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $languages = resolve(LanguageOptions::class)->keys();
        $activity = $this->route('activity');

        return [
            'title' => 'required|max:255',
            'playing_time' => 'required|integer|min:0',
            'language' => 'required|in:' . implode(',', $languages),
            'contact_information' => 'max:255',
            'featured_image' => 'image|mimes:jpeg,jpg,png',
            'proximity_check' => 'integer|in:1',
            'proximity_radius' => 'integer|between:25,100',
        ];
    }
}
