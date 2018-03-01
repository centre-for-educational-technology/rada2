<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;

class ActivityItemPair extends Model
{
    /**
     * Attributes that are appendable to JSON.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
        'image_match_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Sets image_url attribute based on image value.
     * @return string Image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->attributes['image_url'] = $this->getOptionImageUrl();
    }

    /**
     * Sets image_match_url attribute based on image_match value.
     * @return string Image match URL
     */
    public function getImageMatchUrlAttribute()
    {
        return $this->attributes['image_match_url'] = $this->getOptionMatchImageUrl();
    }

    /**
     * Returns image URL
     * @param  string $image Image path
     * @return string        Image URL
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

    /**
     * [deleteImageFile description]
     * @param  string $image [description]
     * @return [type]        [description]
     */
    private function deleteImageFile(string $image) {
        $path = ActivityItem::getStoragePathForId($this->activity_item_id);

        return File::delete( public_path('uploads/images/'. $path . $image) );
    }

    /**
     * [deleteImage description]
     * @return [type] [description]
     */
    public function deleteImage() {
        if ( $this->image ) {
            return $this->deleteImageFile($this->image);
        }

        return false;
    }

    /**
     * [deleteImage description]
     * @return [type] [description]
     */
    public function deleteImageMatch() {
        if ( $this->image_match ) {
            return $this->deleteImageFile($this->image_match);
        }

        return false;
    }
}
