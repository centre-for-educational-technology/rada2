<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Event;
use Carbon\Carbon;
use App\Notifications\ResetPassword;
use Jrean\UserVerification\Traits\UserVerification;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 * @package App
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 * @property $blocked_at
 * @property $verified
 * @property $verification_token
 * @property $email_verified_at
 */
class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;
    use UserVerification;
    use HasApiTokens;

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
     * Define attributes to be logged
     * @var array
     */
    protected static $logAttributes = ['name',];

    /**
     * Retruns user roles
     * @return array Role objects
     */
    public function roles() {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    /**
     * Returns roles data
     *
     * @return array An array of roles data with id
     */
    public function getRolesData(): array
    {
        $rolesData = [];

        if ( $this->roles ) {
            foreach ( $this->roles as $role ) {
                $rolesData[] = [
                    'id' => $role->id,
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
     * Determines if user has a certain role
     *
     * @param  string  $name Role internal name
     *
     * @return boolean
     */
    public function hasRole(string $name): bool
    {
        return $this->roles->keyBy('name')->has($name);
    }

    /**
     * Determines if current user has role of an administrator
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Determines if current user has a role of an editor
     *
     * @return bool
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Returns active relations to DiscountVouchers
     * @return Illuminate\Support\Collection Collection of DiscountVoucher objects with additional data
     */
    public function discountVouchers()
    {
        return $this->belongsToMany(DiscountVoucher::class)
            ->withTimestamps()
            ->withPivot(['valid_until', 'spent',])
            ->orderBy('discount_voucher_user.valid_until', 'desc');
    }

    /**
     * Returns number of DiscountVoucher objects user currently has
     * @return integer Number of discount vouchers
     */
    public function getDiscountVouchersCount(): int
    {
        return $this->belongsToMany(DiscountVoucher::class)
            ->count();
    }

    /**
     * Returns number of unspent and valid DiscountVoucher objects user currently has
     * @return integer Number of discount vouchers
     */
    public function getUnspentAndValidDiscountVouchersCount(): int
    {
        return $this->belongsToMany(DiscountVoucher::class)
            ->wherePivot('spent', 0)
            ->wherePivot('valid_until', '>', Carbon::now())
            ->withPivot(['valid_until', 'spent',])
            ->count();
    }

    /**
     * Awards DiscountVoucher to a User
     * @param  App\DiscountVoucher $voucher DiscountVoucher object
     * @param  App\Game            $game    Game object
     * @return void
     */
    public function awardDiscountVoucher(DiscountVoucher $voucher, Game $game = NULL)
    {
        $dateTime = Carbon::now();
        $dateTime->addHours($voucher->duration);
        $this->discountVouchers()->attach($voucher->id, [
            'valid_until' => $dateTime,
            'game_id' => $game ? $game->id : NULL,
        ]);
        activity()
            ->performedOn($voucher)
            ->withProperties([
                'user_id' => $this->id,
                'valid_until' => $dateTime->toIso8601String(),
                'game_id' => $game ? $game->id : NULL,
            ])
            ->log('awarded');
    }

    /**
     * Checks if current user has at least one instance of DiscountVoucher awarded
     * @param  App\DiscountVoucher $voucher DiscountVoucher object
     * @return boolean
     */
    public function hasDiscountVoucher(DiscountVoucher $voucher): bool
    {
        $count = $this->belongsToMany(DiscountVoucher::class)
            ->wherePivot('discount_voucher_id', $voucher->id)
            ->wherePivot('spent', 0)
            ->wherePivot('valid_until', '>', Carbon::now())
            ->count();

        return $count !== 0;
    }

    /**
     * Determine if the user has been blocked.
     * @return [type] [description]
     */
    public function blocked(): bool
    {
        return ! is_null($this->blocked_at);
    }

    /**
     * Sedn reset password notification
     * @param string $token Password reset token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Determines if user is allowed to make API calls.
     *
     * @return boolean
     */
    public function canMakeApiCalls()
    {
        $identifiers = config('auth.api_access.user_identifiers') ?? [];

        if (!is_array($identifiers)) {
            $identifiers = explode(',', $identifiers);
        }

        return in_array($this->id, $identifiers);
    }
}
