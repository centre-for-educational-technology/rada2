<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * Return user if exists or create if does not.
     *
     * @param  $socialiteUser Socialite user object
     * @return User
     */
    public static function findOrCreateSocialite($socialiteUser) {
        // TODO Need to make sure that mapping is made by social network identifier, not email
        // Email could change and that would lead to unforseen consequences
        if ( $authUser = self::where( 'email', $socialiteUser->getEmail() )->first() ) {
            return $authUser;
        }

        return User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail(),
            'password' => '',
        ]);
    }
}
