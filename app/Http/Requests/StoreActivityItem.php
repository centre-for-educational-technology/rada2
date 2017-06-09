<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\ActivityItem;

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
        return [
            'title' => 'required|max:255',
            'type' => 'required|integer|between:1,7',
            'zoo' => 'required|integer|between:1,3',
            'language' => 'required|in:en,et,ru,fi,swe',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'read_more' => 'url',
            'image' => 'image|mimes:jpeg,jpg,png',
        ];
    }
}
