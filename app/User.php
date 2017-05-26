<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Retruns user roles
     * @return array Role objects
     */
    public function roles() {
        return $this->belongsToMany(Role::class)
            ->withPivot('zoo')
            ->withTimestamps();
    }

    /**
     * Returns roles data
     * @return array An array of roles data with id and zoo keys
     */
    public function getRolesData() {
        $rolesData = [];

        if ( $this->roles ) {
            foreach ( $this->roles as $role ) {
                $rolesData[] = [
                    'id' => $role->id,
                    'zoo' => $role->pivot->zoo,
                ];
            }
        }

        return $rolesData;
    }

    /**
     * Returns social accounts
     * @return array Array of SocialAccount objects
     */
    public function social_accounts() {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * Determines if user has certain role
     * @param  string  $name Role internal name
     * @param  int     $zoo  Zoo identifier, default to NULL
     * @return boolean
     */
    public function hasRole(string $name, int $zoo = null) {
        $rolesByName = $this->roles->keyBy('name');

        if ( $rolesByName->has($name) ) {
            if ( $zoo ) {
                return (int)$rolesByName[$name]->pivot->zoo === (int)$zoo;
            }

            return true;
        }

        return false;
    }

    /**
     * Determines if current user has role of an administrator
     * @return boolean
     */
    public function isAdmin() {
        return $this->hasRole('admin');
    }

    /**
     * Determines if current user has role of a zooAdministrator
     * Also check if role belongs to a certain Zoo
     * @param  int     $zoo Zoo identifier, defaults to NULL
     * @return boolean
     */
    public function isZooAdmin(int $zoo = null) {
        return $this->hasRole('zooAdmin', $zoo);
    }

    /**
     * Determines is current user has role of a zooMember
     * @param  int     $zoo Zoo identifier, defaults to NULL
     * @return boolean
     */
    public function isZooMember(int $zoo = null) {
        return $this->hasRole('zooMember', $zoo);
    }

    /**
     * User badges
     * @return array Array of Badge items
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class)
            ->withTimestamps()
            ->orderBy('badge_user.created_at', 'desc');
    }

    /**
     * Checks if user has a badge
     * @param  Badge   $badge Badge object
     * @return boolean
     */
    public function hasBadge(Badge $badge)
    {
        // XXX A better check logic is needed
        $count = $this->belongsToMany(Badge::class)
            ->wherePivot('badge_id', $badge->id)
            ->count();

        return $count !== 0;
    }

    /**
     * Awards a badge to User if not present
     * @param  Badge $badge Badge object
     * @return void
     */
    public function awardBadge(Badge $badge)
    {
        if ( !$this->hasBadge($badge) )
        {
            $this->badges()->attach($badge->id);
        }
    }
}
