<?php

namespace App\Http\Resources\Subcategory;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'subcategory_name'=>$this->subcategory_name,
        ];
    }
}
