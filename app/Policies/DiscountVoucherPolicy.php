<?php

namespace App\Policies;

use App\User;
use App\DiscountVoucher;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountVoucherPolicy
{
    use HandlesAuthorization;

    /**
     * Overrides permission checks for special users
     * @param  App\User   $user    User object
     * @param  string     $ability Ability to check
     * @return boolean|void    Either returns True to override or does nothing
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view the DiscountVoucher.
     * @param  App\User            $user    User object
     * @param  App\DiscountVoucher $voucher DiscountVoucher object
     * @return boolean
     */
    public function view(User $user, DiscountVoucher $voucher)
    {
        return true;
    }

    /**
     * Determine whether the user can create DiscountVoucher.
     * @param  App\User   $user User object
     * @return boolean
     */
    public function create(User $user)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can update the DiscountVoucher.
     * @param  App\User            $user    User object
     * @param  App\DiscountVoucher $voucher DiscountVoucher object
     * @return boolean
     */
    public function update(User $user, DiscountVoucher $voucher)
    {
        return $user->isEditor();
    }

    /**
     * Determine whether the user can delete the DiscountVoucher.
     * @param  App\User            $user    [description]
     * @param  App\DiscountVoucher $voucher [description]
     * @return boolean
     */
    public function delete(User $user, DiscountVoucher $voucher)
    {
        return $user->isEditor();
    }
}
