<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Tiket;

class TiketRequest extends Request
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
            'id_slip_order' => '',
            'id_staf' => '',
            'subyek' => '',
            'nama_departemen' => '',
            'prioritas' => '',
            'pesan' => ''
        ];
        
        return $rules;
    }
}
