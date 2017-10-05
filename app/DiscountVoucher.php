<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\File;

class DiscountVoucher extends Model
{
    use UuidModel;
    use LogsActivity;

    /**
     * Define that model does not use increments
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Define attributes to be logged
     * @var array
     */
    protected static $logAttributes = ['title', 'duration', 'status',];

    /**
     * Determines if voucher has own image
     * @return boolean
     */
    public function hasImage()
    {
        return !!$this->image;
    }

    /**
     * Get full URL for image from public storage or default one
     * @return string Full public URL to image file
     */
    public function getImageUrl()
    {
        if ( $this->hasImage() )
        {
            return asset('uploads/images/' . $this->image);
        }

        return asset('img/logos/logo-square.png');
    }

    /**
     * Removed image file if one exists
     * @return boolean
     */
    public function deleteImage()
    {
        if ( $this->hasImage() )
        {

            return File::delete( public_path('uploads/images/' . $this->image) );
        }

        return false;
    }

    /**
     * Determines if current voucher is active or not
     * @return boolean
     */
    public function isActive()
    {
        return (boolean) $this->status;
    }
}
