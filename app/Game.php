<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidModel;

use Illuminate\Support\Facades\Log;

class Game extends Model
{
    use UuidModel;

    /**
     * Define that model does not use increments
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Determine if game has been completed.
     * @return boolean Game completion status
     */
    public function isComplete() {
        return (bool)$this->complete;
    }

    /**
     * Get Activity current Game is connected with,.
     * @return App\Activity Activity object.
     */
    public function activity() {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get user account current social one belongs to.
     * @return App\User Application local user account
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get answers for the current game.
     * @return App\GameAnswer [description]
     */
    public function answers() {
        return $this->hasMany(GameAnswer::class);
    }

    /**
     * Returns structure with data used for the game.
     * @return array All the data required for the game
     */
    public function getGameData() {
        $activity = $this->activity;
        $data = [
            'id' => $this->id,
            'complete' => (bool)$this->complete,
            'answers' => [],
        ];

        if ( $this->answers ) {
            foreach ( $this->answers as $answer ) {
                $data['answers'][$answer->activity_item_id] = $answer->getGameData();
            }
        }
        // Force answers to be interpreted as an object if empty
        if ( count($data['answers']) === 0 ) {
            $data['answers'] = (object)$data['answers'];
        }

        $data['activity'] = [
            'id' => $activity->id,
            'title' => $activity->title,
            'description' => $activity->description,
            'type' => $activity->getActivityType($activity->type),
            'difficulty_level_start' => $activity->difficulty_level_start,
            'difficulty_level_end' => $activity->difficulty_level_end,
            'playing_time' => $activity->playing_time,
            'language' => trans('general.languages.' . $activity->language),
            'contact_information' => $activity->contact_information,
            'featured_image' => $activity->getFeaturedImageUrl(),
            'zoo' => $activity->getZoo($activity->zoo),
            'questions' => [],
        ];

        if ( $activity->activityItems ) {
            foreach( $activity->activityItems as $item ) {
                $tmp = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'embedded_content' => $item->embedded_content,
                    'type' => $item->type,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'options' => [],
                    'pairs' => [],
                ];

                if ( $item->options ) {
                    foreach( $item->options as $option ) {
                        $tmp['options'][] = [
                            'id' => $option->id,
                            'option' => $option->option,
                            'image' => $option->getImageUrl(),
                        ];
                    }
                }

                if ( $item->pairs ) {
                    foreach( $item->pairs as $pair ) {
                        $tmp['pairs'][] = [
                            'id' => $pair->id,
                            'option' => $pair->option,
                            'image' => $pair->getOptionImageUrl(),
                            'option_match' => $pair->option_match,
                            'image_match' => $pair->getOptionMatchImageUrl(),
                        ];
                    }
                }

                $data['activity']['questions'][] = $tmp;
            }
        }

        return $data;
    }

    /**
     * Get game completion percentage.
     * @return bool
     */
    public function getCompletionPercentage() {
        if ( $this->isComplete() )
        {
            return 100;
        }

        $answersCount = $this->answers()->count();
        $itemsCount = $this->activity->getActivityItemsCount();

        if ( $itemsCount === 0 )
        {
            return 0;
        }

        return round($answersCount / $itemsCount * 100, 0, PHP_ROUND_HALF_UP);
    }
}
