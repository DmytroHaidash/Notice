<?php

namespace App\Http\Resources;

use App\Jobs\AdvertisementWeatherJobs;
use App\Models\Advertisement;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $trimDescription = mb_substr($this->description, 0, 255,'UTF-8');
        if (strlen($trimDescription) > 0) {
            $trimDescription = rtrim($trimDescription, "!,.-") . '...';
        }

        if(!Cache::has('advertisement_'. $this->id)){
            dispatch(new AdvertisementWeatherJobs(Advertisement::where('id' ,$this->id)->first()));
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'trim_description' => $trimDescription,
            'phone' => $this->phone,
            'country' => $this->country,
            'end_date' => $this->end_date->format('Y-m-d'),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'email' => $this->email,
            'image' => $this->image,
            'created_at' => $this->created_at->format('Y-m-d'),
            'user' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'weather' => Cache::get('advertisement_'. $this->id),
        ];
    }
}
