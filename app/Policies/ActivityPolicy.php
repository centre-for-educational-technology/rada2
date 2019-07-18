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
    public function before(User $user, $ability)
    {

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
        return $user->isZooAdmin() || $user->isZooMember();
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

    public function duplicate(User $user)
    {
        return $user->isZooAdmin() || $user->isZooMember();
    }

    public function startStop(User $user, Activity $activity)
    {
        return $user->isZooAdmin() || ( $user->isZooMember() && $activity->user->id === $user->id);
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
     * Determine whether the user can view results for Activity.
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
     * Determine whether the user can download player positions data for Activity.
     *
     * @param  App\User  $user
     * @param  App\Activity  $activity
     * @return boolean
     */
    public function downloadPlayerPositions(User $user, Activity $activity)
    {
        return $this->viewResults($user, $activity);
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

    /**
     * Determines if user is allowed to add voucher to new activities
     * @param App\User     $user     User model
     * @return boolean
     */
    public function addDiscountVoucher(User $user)
    {
        return false;
    }

    /**
     * Determies if user is allowed to update/remove vouchers from existing activities
     * @param  App\User     $user     User model
     * @param  App\Activity $activity Activity model
     * @return boolean
     */
    public function changeDiscountVoucher(User $user, Activity $activity) {
        return false;
    }

    /**
     * Determines if user is allowed to promote activity
     * @param App\User     $user     User model
     * @return boolean
     */
    public function addPromoted(User $user)
    {
        return $user->isZooAdmin();
    }

    /**
     * Determies if user is allow to change promoted status for actiivty
     * @param  App\User     $user     User model
     * @param  App\Activity $activity Activity model
     * @return boolean
     */
    public function changePromoted(User $user, Activity $activity)
    {
        return $user->isAdmin();
    }
}
