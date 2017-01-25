<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;

class ActivityItemOption extends Model
{
    /**
     * Checks if option is marked as correct answer
     * @return boolean
     */
    public function isCorrect() {
        return (int)$this->correct === 1;
    }

    /**
     * Get full URL for image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getImageUrl() {
        if ( $this->image ) {
            $path = ActivityItem::getStoragePathForId($this->activity_item_id);

            return asset('uploads/images/'. $path . $this->image);
        }

        return null;
    }

    /**
     * [deleteImage description]
     * @return [type] [description]
     */
    public function deleteImage() {
        if ( $this->image ) {
            $path = ActivityItem::getStoragePathForId($this->activity_item_id);

            return File::delete( public_path('uploads/images/'. $path . $this->image) );
        }

        return false;
    }
}
