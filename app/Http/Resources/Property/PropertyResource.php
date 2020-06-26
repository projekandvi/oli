<?php

namespace App\Http\Resources\Property;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'propid'=>$this->propid,
            'cid'=>$this->cid,
            'cityid'=>$this->cityid,
            'userid'=>$this->userid,
            'purpose'=>$this->purpose,
            'name'=>$this->name,
            'description'=>$this->description,
            'amenities'=>$this->amenities,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'image'=>$this->image,
            'status'=>$this->status,
            'featured'=>$this->featured,
            'rate'=>$this->rate,
            'totalrate'=>$this->totalrate,
            'totalview'=>$this->totalview,
            'bed'=>$this->bed,
            'bath'=>$this->bath,
            'area'=>$this->area,
            'price'=>$this->price,
            'floorplan'=>$this->floorplan,

        ];
    }
}
