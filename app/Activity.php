<?php

namespace App;

use App\Interfaces\HasImage;
use App\Options\AgeOfParticipantsOptions;
use App\Repository\GameRepository;
use App\Traits\InteractsWithImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Options\ZooOptions;
use App\Options\LanguageOptions;
use App\Options\DifficultyLevelOptions;

/**
 * Class Activity
 * @package App
 * @property $id
 * @property $title
 * @property $description
 * @property $difficulty_level
 * @property $playing_time
 * @property $language
 * @property $contact_information
 * @property $zoo
 * @property $proximity_check
 * @property $proximity_radius
 * @property $user_id
 * @property $discount_voucher_id
 * @property $promoted
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 * @property $pin
 * @property $keywords
 * @property $parent_id
 * @property $enforce_items_order
 * @property $subject
 * @property $age_of_participants
 * @property $started
 */
class Activity extends Model implements HasImage
{
    const STORAGE_PATH_FORMAT = 'activities/%d/';
    const FILE_NAME_PREFIX = 'featured_image_';

    use SoftDeletes;
    use LogsActivity;
    use InteractsWithImage;

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
     * Delete storage if one exists
     * @return boolean
     */
    public function deleteFileStorage(): bool
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
    public function getZoo(): string
    {
        return resolve(ZooOptions::class)->value($this->zoo);
    }

    /**
     * Returns Language title or key
     * @return string Language title or key
     */
    public function getLanguage(): string
    {
        return resolve(LanguageOptions::class)->value($this->language);
    }

    /**
     * Returns BelongsTo relationship for creator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns BelongsToMany relationship for tasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activityItems()
    {
        return $this->belongsToMany(ActivityItem::class)
            ->withPivot('position')
            ->with('options') // XXX Too eager
            ->with('pairs') // XXX Too eager
            ->with('image')
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
     *
     * @return boolean
     */
    public function hasFeaturedImage(): bool
    {
        return $this->hasImage();
    }

    /**
     * Get full URL for featured image from public storage or default one
     *
     * @param bool $use_default
     *
     * @return string Full public URL to image file
     */
    public function getFeaturedImageUrl(bool $use_default = true): string
    {
        if ( $this->hasFeaturedImage() ) {
            return $this->getImage()->getUrl();
        }

        if (!$use_default) return '';

        return asset('img/logos/logo-square.png');
    }

    /**
     * Deleted a featured image from storage if there is one.
     * Does not set the corresponding attribute to an empty value
     * .
     * @return boolean|null
     * @throws \Exception
     */
    public function deleteFeaturedImage(): ?bool
    {
        if ( $this->hasFeaturedImage() ) {
            return $this->deleteImage();
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

    /**
     * @return array
     */
    public function getKeywordsAsArray()
    {
        return explode(',', $this->keywords);
    }

    /**
     * @return array
     */
    public function getSubjectsAsArray()
    {
        return explode(',', $this->subject);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instructors()
    {
        return $this->hasMany(ActivityInstructor::class);
    }

    /**
     * @return Collection|array
     */
    public function getInstructors()
    {
        return $this->instructors()
            ->orderBy('created_at', 'desc')
            ->getResults();
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function isInstructor(User $user): bool
    {
        return $this->instructors()
            ->where('user_id', '=', $user->id)
            ->count() > 0;
    }

    /**
     * @return array
     */
    public function getInstructorsAsArray()
    {
        /** @var array $instructors */
        $instructors = $this->getInstructors();
        $array = [];
        /** @var ActivityInstructor $instructor */
        foreach ($instructors as $instructor) {
            /** @var User $user */
            $user = $instructor->getUser();
            $array[] = [
                'id' => $instructor->id,
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $instructor->created_at->format('d.m.Y')
            ];
        }

        return $array;
    }

    public function getAgeOfParticipants()
    {
        $list = json_decode($this->age_of_participants, true);
        if (is_array($list)){
            return $list;
        }

        return [];
    }

    public function getAgeOfParticipantsString()
    {
        $translationList = [];
        $list = $this->getAgeOfParticipants();
        $ageOfParticipantsOptions = new AgeOfParticipantsOptions();
        $options = $ageOfParticipantsOptions->options();
        foreach($list as $key) {
            $translationList[] = $options[$key];
        }

        return implode(', ', $translationList);
    }

    public function getAverageRating()
    {
        return GameRepository::getAverageRating($this->id);
    }

    /**
     * Determines if activity is marked as started or not.
     * Only started activities can be played.
     *
     * @return bool
     */
    public function isStarted(): bool
    {
        return (bool)$this->started;
    }
}
