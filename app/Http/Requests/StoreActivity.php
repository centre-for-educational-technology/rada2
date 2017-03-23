<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Activity;

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
        return [
            'type' => 'required|integer|in:1,2',
            'title' => 'required|max:255',
            'difficulty_level_start' => 'required|integer|between:1,99',
            'difficulty_level_end' => 'required|integer|between:1,99',
            'playing_time' => 'integer|min:0',
            'language' => 'required|in:en,et,ru,fi,swe',
            'contact_information' => 'max:255',
            'featured_image' => 'image|mimes:jpeg,jpg,png',
            'zoo' => 'required|in:1,2,3',
            'proximity_check' => 'integer|in:1',
            'proximity_radius' => 'integer|between:25,100',
        ];
    }
}
