<?php

namespace App\Http\Resources\Destination;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
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
            'category_id'=>$this->category_id,
            'subcategory_id'=>$this->subcategory_id,
            'name'=>$this->name,
            'image'=> 'http://museum.dvitest.id/uploads/destinations'.$this->image,
            'detail'=>$this->detail,
            'phone'=>$this->phone,
            'price'=>$this->price,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'total_views'=>$this->total_views,
        ];
    }
}
