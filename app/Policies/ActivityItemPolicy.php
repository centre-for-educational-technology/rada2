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
     * @return mixed
     */
    public function view(User $user, ActivityItem $item)
    {
        return true;
    }

    /**
     * Determine whether the user can create ActivityItems.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the ActivityItem.
     *
     * @param  App\User  $user
     * @param  App\ActivityItem  $item
     * @return mixed
     */
    public function update(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id;
    }

    /**
     * Determine whether the user can delete the ActivityItem.
     *
     * @param  App\User  $user
     * @param  App\ActivityItem  $item
     * @return mixed
     */
    public function delete(User $user, ActivityItem $item)
    {
        return $user->id === $item->user_id;
    }
}
