<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use App\Traits\HasUuid;

class Image extends Model
{
    use HasFactory;
    use HasUuid;

    protected $casts = [
        'custom_properties' => 'array',
    ];

    protected $appends = ['url'];

    protected $fillable = [
        'file_name',
        'path',
        'mime_type',
        'size',
        'custom_properties',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function($item) {
            $path = public_path('uploads/images/' . $item->path . $item->file_name);

            if ( File::exists($path) ) {
                File::delete($path);
            }
        });

    }

    public function getUrlAttribute(): string
    {
        return $this->getUrl();
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrl(): string
    {
        return asset('uploads/images/' . $this->path . $this->file_name);
    }

    public function hasCustomProperty(string $propertyName): bool
    {
        return Arr::has($this->custom_properties, $propertyName);
    }

    public function getCustomProperty(string $propertyName, $default = null)
    {
        return Arr::get($this->custom_properties, $propertyName, $default);
    }

    public function hasExternalProvider(): bool
    {
        return $this->hasCustomProperty('provider');
    }

    public function isFromExternalProvider(string $provider): bool
    {
        return $this->hasExternalProvider() && $this->getExternalProvider()['name'] === $provider;
    }

    public function getExternalProvider(): array
    {
        return $this->getCustomProperty('provider', []);
    }
}
