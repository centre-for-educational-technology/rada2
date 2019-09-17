<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityFlashExercise
 * @package App
 *
 * @property $id
 * @property $activity_id
 * @property $activity_item_id
 * @property $user_id
 * @property $active
 * @property $created_at
 * @property $updated_at
 */
class ActivityFlashExercise extends Model
{
    public const TABLE_NAME = 'activity_flash_exercises';
}
