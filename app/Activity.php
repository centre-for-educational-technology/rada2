<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Activity extends Model
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
     * Returns Zoo options
     * @return array Options for Zoo select
     */
    public static function getZooOptions()
    {
        return [
            1 => trans('general.zoos.skansen'),
            2 => trans('general.zoos.korkeasaari'),
            3 => trans('general.zoos.tallinn'),
        ];
    }

    /**
     * Returns Language options
     * @return array Options or Language select
     */
    public static function getLanguageOptions()
    {
        return [
            'en' => trans('general.languages.en'),
            'et' => trans('general.languages.et'),
            'ru' => trans('general.languages.ru'),
            'fi' => trans('general.languages.fi'),
            'swe' => trans('general.languages.swe'),
        ];
    }

    /**
     * Returns Activity Type options
     * @return array Options for Activity Type select
     */
    public static function getActivityTypeOptions()
    {
        return [
            1 => trans('general.activity-type.collecting-cards'),
            2 => trans('general.activity-type.treasure-hunt'),
        ];
    }

    /**
     * Returns minimum value for Difficulty Level
     * @return int Value
     */
    public static function getDifficultyLevelMinimum()
    {
        return 1;
    }

    /**
     * Returns maximum value for Difficulty Level
     * @return int Value
     */
    public static function getDifficultyLevelMaximum()
    {
        return 99;
    }

    /**
     * Get user account current social one belongs to.
     * @return User Application local user account
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Determines if activity has own Featured Image
     * @return boolean
     */
    public function hasFeaturedImage() {
        return !!$this->featured_image;
    }

    /**
     * Get full URL for featured image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getFeaturedImageUrl() {
        if ( $this->hasFeaturedImage() ) {
            return asset('uploads/images/'. $this->featured_image);
        }

        return asset('img/logos/logo-square.png');
    }

    /**
     * Checks if current user can edit activity or not
     * @return bool
     */
    public function canEdit() {
        if ( Auth::check() ) {
            // TODO This one is missing the checks for additional roles
            // Administrator should be able to edit or delete anything
            // Zoo specific roles are a bit more problematic: one issue would arise
            // if someone changes the zoo and suddenly same person who changed becomes
            // locked out
            $user = Auth::user();

            if ( $user->id === $this->user_id) {
                return true;
            }
        }

        return false;
    }
}
