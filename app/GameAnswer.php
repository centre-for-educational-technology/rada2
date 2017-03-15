<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameAnswer extends Model
{
    /**
     * Get Activity current Game is connected with,.
     * @return Activity Activity object.
     */
    public function activityItem()
    {
        return $this->belongsTo(ActivityItem::class);
    }

    /**
     * Get user account current social one belongs to.
     * @return User Application local user account
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
            return asset('uploads/images/'. $this->game_id . '/' . $this->image);
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
            'answer' => (array)json_decode($this->answer),
            'image' => $this->getImageUrl(),
            'correct' => (bool)$this->correct,
        ];
    }
}
