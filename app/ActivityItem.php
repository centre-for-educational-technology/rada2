<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Returns ActivityItem Question Type options
     * @return array Options for ActivityItem Question Type select
     */
    public static function getQuestionTypeOptions()
    {
        return [
            1 => trans('general.question-types.information'),
            2 => trans('general.question-types.one-correct-answer'),
            3 => trans('general.question-types.multiple-correct-answers'),
            4 => trans('general.question-types.freeform-answer'),
            5 => trans('general.question-types.match-pairs'),
            6 => trans('general.question-types.embedded-content'),
            7 => trans('general.question-types.photo'),
        ];
    }

    /**
     * Returns question type title
     * @param  int    $id Question type key
     * @return string     Question type title
     */
    public static function getQuestionType(int $id) {
        $types = self::getQuestionTypeOptions();

        if ( array_key_exists($id, $types) ) {
            return $types[$id];
        }

        return $id;
    }

    /**
     * Returns geolocaions for Zoos
     * @return array Options for Zoos geolocation data
     */
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

    /**
     * Get user account current social one belongs to.
     * @return User Application local user account
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
