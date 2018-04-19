<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;

class ActivityItemOption extends Model
{
    /**
     * Attributes that are appendable to JSON.
     *
     * @var array
     */
    protected $appends = [
        'image_url',
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
        return $this->attributes['image_url'] = $this->getImageUrl();
    }

    /**
     * Checks if option is marked as correct answer
     * @return boolean
     */
    public function isCorrect()
    {
        return (int)$this->correct === 1;
    }

    /**
     * Get full URL for image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getImageUrl()
    {
        if ( $this->image )
        {
            $path = ActivityItem::getStoragePathForId($this->activity_item_id);

            return asset('uploads/images/'. $path . $this->image);
        }

        return null;
    }

    /**
     * Determine if image exists
     * @return boolean
     */
    public function hasImage()
    {
        return !!$this->image;
    }

    /**
     * Deletes an image from storage if there is one.
     * Does not set the corresponding attribute to an empty value.
     * @return boolean
     */
    public function deleteImage()
    {
        if ( $this->hasImage() )
        {
            $path = ActivityItem::getStoragePathForId($this->activity_item_id);

            return File::delete( public_path('uploads/images/'. $path . $this->image) );
        }

        return false;
    }
}
