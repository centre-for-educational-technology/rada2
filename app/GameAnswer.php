<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class GameAnswer extends Model
{
    use LogsActivity;

    /**
     * Define attributes to be logged
     * @var array
     */
    protected static $logAttributes = ['game_id', 'activity_item_id'];

    /**
     * Get Activity current Game is connected with,.
     * @return Activity Activity object.
     */
    public function activityItem()
    {
        return $this->belongsTo(ActivityItem::class);
    }

    /**
     * Get Game the Answer belongs to
     * @return Game
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get full URL for image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getImageUrl()
    {
        if ( $this->image ) {
            return asset('uploads/images/'. $this->game->getStoragePath() . '/' . $this->image);
        }

        return null;
    }

    /**
     * [getGameData description]
     * @return [type] [description]
     */
    public function getGameData()
    {
        return [
            'question' => $this->activity_item_id,
            'answer' => json_decode($this->answer, true),
            'image' => $this->getImageUrl(),
            'correct' => (bool)$this->correct,
        ];
    }
}
