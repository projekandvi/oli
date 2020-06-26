<?php

namespace App\Http\Resources\User;

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
            'id'=>$this->id,
            'name'=>$this->name,
            'gender'=>$this->gender,
            'email'=>$this->email,
            'email_verified_at'=>$this->email_verified_at,
            'password'=>$this->password,
            'is_admin'=>$this->is_admin,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'remebemr_token'=>$this->remember_token,
        ];
    }
}
