<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPosition extends Model
{
    /**
     * Primary key
     * @var mixed
     */
    protected $primaryKey = null;

    /**
     * Indicates that identifiers are auto incrementing
     * @var bool
     */
    public $incrementing = false;

    /**
     * If timestamps are set automatically or not
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get Game object current location belongs to
     * @return User
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
