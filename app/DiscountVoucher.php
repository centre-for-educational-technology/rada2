<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidModel;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\File;
use App\User;

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
     * Return storage path for DiscounVoucher
     * @return string Path to directory
     */
    public function getStoragePath()
    {
        return self::getStoragePathForId($this->id);
    }

    /**
     * Return storage path for given DiscountVoucher id
     * @param  string    $id DiscountVoucher id
     * @return string     Path to directory
     */
    public static function getStoragePathForId(string $id)
    {
        return 'discount_vouchers/' . $id . '/';
    }

    /**
     * Delete storage if one exists
     * @return boolean
     */
    public function deleteFileStorage()
    {
        $fullPath = public_path('uploads/images/' . $this->getStoragePath());

        if ( File::exists($fullPath) && File::isDirectory($fullPath) )
        {
            File::deleteDirectory($fullPath);
        }

        return false;
    }

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
            return asset('uploads/images/' . $this->getStoragePath() . $this->image);
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
            return File::delete( public_path('uploads/images/' . $this->getStoragePath() . $this->image) );
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

    /**
     * Determines if current voucher has an amount limit set
     * @return boolean
     */
    public function hasAmountLimitation()
    {
        return (bool) $this->amount;
    }

    /**
     * Returns number of awarded vouchers
     * @return integer
     */
    public function awardedCount()
    {
        return $this->belongsToMany(User::class)->count();
    }

    /**
     * Determines if voucher can be awarded
     * @return boolean
     */
    public function canBeAwarded()
    {
        if ( !$this->isActive() )
        {
            return false;
        }
        else if ( !$this->hasAmountLimitation() )
        {
            return true;
        }

        return $this->awardedCount() < (int) $this->amount;
    }
}
