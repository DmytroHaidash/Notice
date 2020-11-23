<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'user' => new UserResource($this->user),
            'advertisement_id' => $this->advertisement_id,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at,
        ];
    }
}
