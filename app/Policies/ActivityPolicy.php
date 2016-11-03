<?php

namespace App\Policies;

use App\User;
use App\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Support\Facades\Log;

class ActivityPolicy
{
    use HandlesAuthorization;
    /**
     * Overrides permission checks for special users
     * @param  User   $user    User oject to check
     * @param  string $ability Ability to check
     * @return boolean|void    Either returns True to override or does nothing
     */
    public function before(User $user, $ability) {

        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return mixed
     */
    public function view(User $user, Activity $activity)
    {
        return true;
    }

    /**
     * Determine whether the user can create activities.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return mixed
     */
    public function update(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id;
    }

    /**
     * Determine whether the user can delete the activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return mixed
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id;
    }
}
