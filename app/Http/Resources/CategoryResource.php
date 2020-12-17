<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'children' => CategoryResource::collection($this->children),
            'count_ads' => $this->advertisements->count(),
            'parent' => $this->parent_id ? [
                'id' => $this->parent->id,
                'title' => $this->parent->title,
                ] : null,
        ];
    }
}
