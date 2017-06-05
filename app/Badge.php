<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidModel;

class Badge extends Model
{
    use UuidModel;

    /**
     * Define that model does not use increments
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Returns URL of the image based on badge "type" value
     * @return string URL of the image asset
     */
    public function getImageUrl()
    {
        return asset('img/badges/' . $this->type . '.png');
    }

    /**
     * Returns URL for badge criteria.
     * Links to a certain spot of badges listing page.
     * @return [type] [description]
     */
    public function getCriteriaUrl()
    {
        return route('badge.index', ['#' . $this->type]);
    }

    /**
     * Returns badge by type provided. Can throw an exception.
     * @param  string $type Badge type
     * @return App\Badge    Badge object
     */
    public static function getBadgeByType(string $type)
    {
        return self::where('type', '=', $type)->first();
    }
}