<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'gender'=>$this->gender,
            'photo_profile'=>$this->photo_profile,
            'birth_date'=>$this->birth_date,
            'email'=>$this->email,
            'address'=>$this->address,
            'phone'=>$this->phone,
        ];
    }
}
