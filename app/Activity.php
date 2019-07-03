<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Options\ZooOptions;
use App\Options\LanguageOptions;
use App\Options\DifficultyLevelOptions;

class Activity extends Model
{
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * Define attributes to be logged
     * @var array
     */
    protected static $logAttributes = ['title',];

    /**
     * Return storage path for Activity
     * @return string Path to directory
     */
    public function getStoragePath()
    {
        return self::getStoragePathForId($this->id);
    }

    /**
     * Return storage path for given Activity id
     * @param  int    $id Activity id
     * @return string Path to directory
     */
    public static function getStoragePathForId(int $id)
    {
        return 'activities/' . $id . '/';
    }

    /**
     * Delete storage if one exists
     * @return boolean
     */
    public function deleteFileStorage()
    {
        $fullPath = public_path('uploads/images/' . $this->getStoragePath());

        if ( File::exists($fullPath) && File::isDirectory($fullPath) )
        {
            File::deleteDirectory($fullPath);
        }

        return false;
    }

    /**
     * Returns Zoo title
     * @return string Zoo title or key
     */
    public function getZoo()
    {
        return resolve(ZooOptions::class)->value($this->zoo);
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
     * Get user account current social one belongs to.
     * @return User Application local user account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [activityItems description]
     * @return [type] [description]
     */
    public function activityItems()
    {
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
    public function games()
    {
        return $this->hasMany(Game::class);
    }

    /**
     * Get DiscountVoucher assigned to current activity.
     * @return DiscountVoucher|NULL Assigned discount voucher or an empty value
     */
    public function discountVoucher()
    {
        return $this->belongsTo(DiscountVoucher::class);
    }

    /**
     * Returns count of ActivityItems.
     * @return integer Nymber of connected elements
     */
    public function getActivityItemsCount()
    {
        return $this->belongsToMany(ActivityItem::class)->count();
    }

    /**
     * Determines if activity has own Featured Image
     * @return boolean
     */
    public function hasFeaturedImage()
    {
        return !!$this->featured_image;
    }

    /**
     * Get full URL for featured image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getFeaturedImageUrl()
    {
        if ( $this->hasFeaturedImage() ) {
            return asset('uploads/images/' . $this->getStoragePath() . $this->featured_image);
        }

        return asset('img/logos/logo-square.png');
    }

    /**
     * Deleted a featured image from storage if there is one.
     * Does not set the corresponding attribute to an empty value.
     * @return boolean
     */
    public function deleteFeaturedImage()
    {
        if ( $this->hasFeaturedImage() ) {
            return File::delete( public_path('uploads/images/' . $this->getStoragePath() . $this->featured_image) );
        }

        return false;
    }

    /**
     * Returns Activity Game status lookup structure for current user.
     * @return array Statuses of Games for current User keyed by Activity ID
     */
    private function getUserGamesLookup()
    {
        static $games;

        if ( !isset($games) )
        {
            if ( Auth::check() )
            {
                $games = DB::table('games')->where('user_id', Auth::user()->id)->select('activity_id', 'complete')->get();
                $games = $games->keyBy('activity_id');
            }
            else
            {
                $games = [];
            }
        }

        return $games;
    }

    /**
     * Determined Activity Game status for current User if any
     * @return mixed Returns either 0, 1 or false
     */
    public function getUserGameStatus()
    {
        if ( Auth::check() )
        {
            $games = $this->getUserGamesLookup();

            if ( $games->has($this->id) )
            {
                return $games->get($this->id)->complete;
            }
        }
        return false;
    }

    /**
     * Returns Difficulty Level title
     * @return string Difficulty Level title or key
     */
    public function getDifficultyLevel()
    {
        return resolve(DifficultyLevelOptions::class)->value($this->difficulty_level);
    }

    /**
     * Checks if Activity is promoted or not
     * @return boolean
     */
    public function isPromoted()
    {
        return (bool)$this->promoted;
    }

    public function getKeywordsAsArray()
    {
        return explode(',', $this->keywords);
    }

    public function getAgeOfParticipants()
    {
        $list = json_decode($this->age_of_participants, true);
        if (is_array($list)){
            return $list;
        }

        return [];
    }
}
