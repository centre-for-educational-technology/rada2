<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SocialAccount extends Model
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider',
    ];

    /**
     * Define attributes to be logged
     * @var array
     */
    protected static $logAttributes = ['user_id', 'provider'];

    /**
     * Get user account current social one belongs to.
     * @return User Application local user account
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * [checkProvider description]
     * @param  string $provider [description]
     * @return [type]           [description]
     */
    private function checkProvider(string $provider) {
        return $this->provider === $provider;
    }

    /**
     * [isGoogle description]
     * @return boolean [description]
     */
    public function isGoogle() {
        return $this->checkProvider('GoogleProvider');
    }

    /**
     * [isFacebook description]
     * @return boolean [description]
     */
    public function isFacebook() {
        return $this->checkProvider('FacebookProvider');
    }
}
