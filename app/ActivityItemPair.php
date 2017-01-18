<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityItemPair extends Model
{
    /**
     * [getImageUrl description]
     * @param  string $image [description]
     * @return [type]        [description]
     */
    private function getImageUrl(string $image) {
        $path = ActivityItem::getStoragePathForId($this->activity_item_id);

        return asset('uploads/images/'. $path . $image);
    }

    /**
     * Get full URL for option image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getOptionImageUrl() {
        if ( $this->image ) {
            return $this->getImageUrl($this->image);
        }

        return null;
    }

    /**
     * Get full URL for option match image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getOptionMatchImageUrl() {
        if ( $this->image_match ) {
            return $this->getImageUrl($this->image_match);
        }

        return null;
    }
}
