<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Options\ZooOptions;
use App\Options\ActivityTypeOptions;
use App\Options\LanguageOptions;

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
     * Returns Zoo title
     * @return string Zoo title or key
     */
    public function getZoo()
    {
        return resolve(ZooOptions::class)->value($this->zoo);
    }

    /**
     * Returns Activity Type title
     * @return string Activity type title or key
     */
    public function getActivityType()
    {
        return resolve(ActivityTypeOptions::class)->value($this->type);
    }

    /**
     * Returns Language title or key
     * @return string Language title or key
     */
    public function getLanguage()
    {
        return resolve(LanguageOptions::class)->value($this->language);
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
     * [activityItems description]
     * @return [type] [description]
     */
    public function activityItems() {
        return $this->belongsToMany(ActivityItem::class)
            ->withPivot('position')
            ->with('options') // XXX Too eager
            ->with('pairs') // XXX Too eager
            ->withTimestamps()
            ->orderBy('position', 'asc');
    }

    /**
     * [games description]
     * @return [type] [description]
     */
    public function games() {
        return $this->hasMany(Game::class);
    }

    /**
     * [getActivityItemsCount description]
     * @return [type] [description]
     */
    public function getActivityItemsCount() {
        return $this->belongsToMany(ActivityItem::class)->count();
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
            return asset('uploads/images/' . $this->featured_image);
        }

        return asset('img/logos/logo-square.png');
    }

    /**
     * [deleteImage description]
     * @return [type] [description]
     */
    public function deleteFeaturedImage() {
        if ( $this->hasFeaturedImage() ) {

            return File::delete( public_path('uploads/images/' . $this->featured_image) );
        }

        return false;
    }
}
