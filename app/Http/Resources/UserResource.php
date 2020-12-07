<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'image' => $this->image,
            'about' => $this->about,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'subscribe' => $this->subscribes,
            'role' =>$this->role
        ];
    }
}
