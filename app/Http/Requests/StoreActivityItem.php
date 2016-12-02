<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Activity;

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
            //
        ];
    }
}
