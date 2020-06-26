<?php

namespace App\Http\Resources\Rating;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'id'=>$this->id,
            'destination_id'=>$this->destination_id,
            'ip'=>$this->ip,
            'rate'=>$this->rate,
            'daterate'=>$this->daterate,
        ];
    }
}
