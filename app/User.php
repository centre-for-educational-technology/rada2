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
     * [roles description]
     * @return [type] [description]
     */
    public function roles() {
        return $this->belongsToMany(Role::class)
            ->withPivot('zoo')
            ->withTimestamps();
    }

    /**
     * [getRolesData description]
     * @return [type] [description]
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
     * [pairs description]
     * @return [type] [description]
     */
    public function social_accounts() {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * [hasRole description]
     * @param  string  $name [description]
     * @param  [type]  $zoo  [description]
     * @return boolean       [description]
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
     * Determined if current user is an administrator
     * @return boolean
     */
    public function isAdmin() {
        return $this->hasRole('admin');
    }

    /**
     * [isZooAdmin description]
     * @param  int     $zoo [description]
     * @return boolean      [description]
     */
    public function isZooAdmin(int $zoo = null) {
        return $this->hasRole('zooAdmin', $zoo);
    }

    /**
     * [isZooMember description]
     * @param  int     $zoo [description]
     * @return boolean      [description]
     */
    public function isZooMember(int $zoo = null) {
        return $this->hasRole('zooMember', $zoo);
    }
}
