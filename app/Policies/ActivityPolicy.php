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
     * Determine whether the user can view the Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return boolean
     */
    public function view(User $user, Activity $activity)
    {
        return true;
    }

    /**
     * Determine whether the user can create Activities.
     *
     * @param  App\User  $user
     * @return boolean
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return boolean
     */
    public function update(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id || $user->isZooAdmin($activity->zoo) || $user->isZooMember($activity->zoo);
    }

    /**
     * Determine whether the user can delete the Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return boolean
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id || $user->isZooAdmin($activity->zoo) || $user->isZooMember($activity->zoo);
    }

    /**
     * Determine whether the user can view Activities results list.
     *
     * @param  App\User  $user
     * @return boolean
     */
    public function viewResultsList(User $user)
    {
        return $user->isZooAdmin() || $user->isZooMember();
    }

    /**
     * Determine whether the user view results for Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return boolean
     */
    public function viewResults(User $user, Activity $activity)
    {
        return $user->isZooAdmin($activity->zoo) || $user->isZooMember($activity->zoo);
    }

    /**
     * Determines if the user is allowed to change Zoo value.
     * @param  App\User     $user     User object
     * @param  App\Activity $activity Activity object
     * @return boolean
     */
    public function changeZoo(User $user, Activity $activity)
    {
        return $user->id === $activity->user_id;
    }
}
