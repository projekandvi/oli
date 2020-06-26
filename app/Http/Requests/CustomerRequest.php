<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Customer;

class CustomerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $routeUserId = $this->route('user');
        // $userId = $routeUserId ? $routeUserId->id : null;

        $rules = [
            'crc_code' => '',
            'la_code' => '',
            'nama_customer' => '',
            'no_ktp' => '',
            'alamat' => '',
            'no_telp' => '',
            'no_hp' => '',
            'email' => ''
        ];
        
        return $rules;
    }
}
