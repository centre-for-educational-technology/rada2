<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityInstructor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'activity_id',
        'user_id'
    ];

    /**
     * Get activity
     * @return Activity|null
     */
    public function getActivity()
    {
        return Activity::find($this->activity_id);
    }

    /**
     * Get user
     * @return User|null
     */
    public function getUser()
    {
        return User::find($this->user_id);
    }
}