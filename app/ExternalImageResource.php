<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalImageResource extends Model
{
    protected $casts = [
        'external_data' => 'array',
    ];

    use HasFactory;

    public static function createFromMuinas(array $data): array
    {
        $resources = [];

        foreach($data['images'] as $image) {
            // TODO Use create method with mass assignment
            $resource = new self;
            $resource->title = $data['title'];
            $resource->description = '';
            $resource->provider = 'muinas';
            $resource->image_url = $image['file'];
            $resource->external_data = $data;
            $resource->save();

            $resources[] = $resource;
        }

        return $resources;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }
}
