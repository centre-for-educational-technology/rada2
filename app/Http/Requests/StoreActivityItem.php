<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\ActivityItem;

use App\Options\LanguageOptions;

class StoreActivityItem extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      $activity_item = $this->route('activity_item');

      if ( $activity_item ) {
          return $activity_item && $this->user()->can('update', $activity_item);
      } else {
          return $this->user()->can('create', ActivityItem::class);
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
        $activityItem = $this->route('activity_item');

        return [
            'title' => 'required|max:255',
            'type' => 'required|integer|between:1,7',
            'zoo' => ( $activityItem && auth()->user()->cannot('changeZoo', $activityItem) ) ? 'integer|between:1,3' : 'required|integer|between:1,3',
            'language' => 'required|in:' . implode(',', $languages),
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'read_more' => 'url',
            'image' => 'image|mimes:jpeg,jpg,png',
        ];
    }
}
