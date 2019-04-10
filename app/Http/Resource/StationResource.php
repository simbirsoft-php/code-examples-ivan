<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this['name'],
            'address' => $this['address'],
            'description' => $this['description'],
            'schedules' => new ScheduleResource($this['schedules'])
        ];
    }
}
