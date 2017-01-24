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
     * Determines if question is of certain type
     * @param  int     $type Question type identifier
     * @return boolean
     */
    private function isQuestionOfType(int $type) {
        return (int)$this->type === $type;
    }

    /**
     * Determines if question has type of embedded-content
     * @return boolean
     */
    public function isEmbeddedContent() {
        return $this->isQuestionOfType(6);
    }

    /**
     * Determines if question has type of one-correct-answer
     * @return boolean
     */
    public function isOneCorrectAnswer() {
        return $this->isQuestionOfType(2);
    }

    /**
     * Determines if question has type of multiple-correct-answers
     * @return boolean
     */
    public function isMultipleCorrectAnswers() {
        return $this->isQuestionOfType(3);
    }

    /**
     * Determines if question has type of match-pairs
     * @return boolean [description]
     */
    public function isMatchPairs() {
        return $this->isQuestionOfType(5);
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

    /**
     * Get options that belong to current ActivityItem
     * @return [type] [descripion]
     */
    public function options() {
        return $this->hasMany(ActivityItemOption::class);
    }

    /**
     * [pairs description]
     * @return [type] [description]
     */
    public function pairs() {
        return $this->hasMany(ActivityItemPair::class);
    }

    /**
     * Returns storage path hash for the ActivityItem
     * @return string SHA1 hash used for storage path
     */
    public function getStoragePath() {
        return self::getStoragePathForId($this->id);
    }

    /**
     * [getStoragePathForId description]
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public static function getStoragePathForId(int $id) {
        return sha1( 'activity_item_' . $id ) . '/';
    }

    /**
     * Get question data if available, with limited selected columns.
     * This method is useful for construction of edit form.
     * @return array Array with data objects or an empty one
     */
    public function getQuestionData() {
        if ( $this->isOneCorrectAnswer() || $this->isMultipleCorrectAnswers() ) {
            return $this->options()->get(['id', 'option', 'correct', 'image']);
        } else if ( $this->isMatchPairs() ) {
            return $this->pairs()->get(['id', 'option', 'image', 'option_match', 'image_match']);
        }

        return [];
    }
}
