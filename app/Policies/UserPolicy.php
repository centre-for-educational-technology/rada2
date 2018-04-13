<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Overrides permission checks for special users
     * @param  User   $user    User oject to check
     * @param  string $ability Ability to check
     * @return boolean|void    Either returns True to override or does nothing
     */
    public function before(User $user, $ability) {

        if ($user->isAdmin()) {
            if ( $ability !== 'delete' && $ability !== 'block' )
            {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can view the Activity.
     *
     * @param  App\User  $actor
     * @param  App\User  $user
     * @return mixed
     */
    public function view(User $actor, User $user)
    {
        return $actor->id === $user->id;
    }

    /**
     * Determine whether the user can create Activities.
     *
     * @param  App\User  $actor
     * @return mixed
     */
    public function create(User $actor)
    {
        return true;
    }

    /**
     * Determine whether the user can update the Activity.
     *
     * @param  App\User  $actor
     * @param  App\User  $user
     * @return mixed
     */
    public function update(User $actor, User $user)
    {
        return $actor->id === $user->id;
    }

    /**
     * Determine whether the user can delete the Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return mixed
     */
    public function delete(User $actor, User $user)
    {
        return false;
    }

    /**
     * Determine wherther blocking/unblocking is allowed.
     * @param  App\User   $actor Actor User object
     * @param  App\User   $user  Target User object
     * @return boolean
     */
    public function block(User $actor, User $user)
    {
        return $actor->isAdmin() && ( $actor->id !== $user->id );
    }
}
