<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->game->getUserName(),
            'answer' => json_decode($this->answer, true),
            'image_url' => $this->getImageUrl(),
            'created_at' => $this->created_at->toRfc3339String(),
            'updated_at' => $this->updated_at->toRfc3339String(),
        ];
    }
}
