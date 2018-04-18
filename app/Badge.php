<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Lang;

use App\Traits\UuidModel;

class Badge extends Model
{
    use UuidModel;
    use LogsActivity;

    const IMAGE_VERSION = 1;

    /**
     * Define that model does not use increments
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Return attribute translation key
     * @param  string $attribute Attribute name
     * @return string            Translation key
     */
    private function getTranslationKey(string $attribute)
    {
        return 'badges.' . $this->type . '.' . $attribute;
    }

    /**
     * Return translation if one exists or current value
     * @param  string $attribute Attribute name
     * @param  string $value     Current attribute value
     * @return string            Translation or current value
     */
    private function getAttributeTranslation(string $attribute, string $value)
    {
        $translationKey = $this->getTranslationKey($attribute);

        return Lang::has($translationKey) ? trans($translationKey) : $value;
    }

    /**
     * Return translated name or current value
     * @param  string $value Currrent value
     * @return string        Translation or current value
     */
    public function getNameAttribute($value)
    {
        return $this->getAttributeTranslation('name', $value);
    }

    /**
     * Retrun translated description or current value
     * @param  string $value Current value
     * @return string        Translation or current value
     */
    public function getDescriptionAttribute($value)
    {
        return $this->getAttributeTranslation('description', $value);
    }

    /**
     * Returns URL of the image based on badge "type" value
     * @param bool $vector Return URL for vector or raster image, defaults to true
     * @return string URL of the image asset
     */
    public function getImageUrl($vector = true)
    {
        $extension = ($vector === true) ? 'svg' : 'png';
        return asset('img/badges/' . $this->type . '.' . $extension . '?v=' . self::IMAGE_VERSION);
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
