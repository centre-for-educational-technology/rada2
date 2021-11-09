<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Registers a listener for the creating event and fills creates a UUID if one is empty.
     */
    public static function bootHasUuid()
    {
        static::creating(function (Model $model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Finds a model by UUID, if one exists.
     *
     * @param string $uuid Model UUID value.
     * @return Model|null  Model or null.
     */
    public static function findByUuid(string $uuid): ?Model
    {
        return static::where('uuid', $uuid)->first();
    }
}