<?php

namespace App\Policies;

use App\User;
use App\ActivityItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityItemPolicy
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
     * Determine whether the user can view the ActivityItem.
     *
     * @param  App\User  $user
     * @param  App\ActivityItem  $item
     * @return boolean
     */
    public function view(User $user, ActivityItem $item)
    {
        return true;
    }

    /**
     * Determine whether the user can create ActivityItems.
     *
     * @param  App\User  $user
     * @return boolean
     */
    public function create(User $user)
    {
        return $user->isZooAdmin() || $user->isZooMember();
    }

    /**
     * Determine whether the user can update the ActivityItem.
     *
     * @param  App\User  $user
     * @param  App\ActivityItem  $item
     * @return boolean
     */
    public function update(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id || $user->isZooAdmin($item->zoo) || $user->isZooMember($item->zoo);
    }

    /**
     * Determine whether the user can delete the ActivityItem.
     *
     * @param  App\User  $user
     * @param  App\ActivityItem  $item
     * @return boolean
     */
    public function delete(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id || $user->isZooAdmin($item->zoo) || $user->isZooMember($item->zoo);
    }

    /**
     * Determines if the user can change Zoo value.
     * @param  App\User         $user User object
     * @param  App\ActivityItem $item ActivityItem object
     * @return boolean
     */
    public function changeZoo(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id;
    }

    /**
     * Determines if the user can see correct answer for certain question types
     * @param  App\User         $user User object
     * @param  App\ActivityItem $item ActivityItem object
     * @return boolean
     */
    public function viewCorrectAnswer(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id || $user->isZooAdmin() || $user->isZooMember();
    }
}
