<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\DeliveryOrder;

class DeliveryOrderRequest extends Request
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
            'id_do' => '',
            'tanggal' => '',
            'id_invoice' => '',
            'id_staf' => ''
        ];
        
        return $rules;
    }
}
