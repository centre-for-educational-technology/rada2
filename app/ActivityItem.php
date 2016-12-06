<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityItem extends Model
{
    /**
     * Returns ActivityItem Question Type options
     * @return array Options for ActivityItem Question Type select
     */
    public static function getQuestionTypeOptions()
    {
        return [
            1 => trans('general.question-types.one-correct-answer'),
            2 => trans('general.question-types.multiple-correct-answers'),
            3 => trans('general.question-types.freeform-answer'),
            4 => trans('general.question-types.match-pairs'),
            5 => trans('general.question-types.embedded-content'),
            6 => trans('general.question-types.photo'),
            7 => trans('general.question-types.information'),
        ];
    }

    public static function getZooGeolocationOptions() {
        return [
            1 => [
                'lat' => 59.3270,
                'lng' => 18.1037,
            ],
            2 => [
                'lat' => 60.1750,
                'lng' => 24.9861,
            ],
            3 => [
                'lat' => 59.4259,
                'lng' => 24.6595,
            ]
        ];
    }
}
