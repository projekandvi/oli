<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Lead;

class LeadRequest extends Request
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
            'nama_lead' => '',
            'tempat_lahir_lead' => '',
            'tanggal_lahir_lead' => '',
            'nik_lead' => '',
            'nomor_handphone_lead' => '',
            'email_lead' => ''
        ];
        
        return $rules;
    }
}
