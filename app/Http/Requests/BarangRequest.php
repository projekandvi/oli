<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Barang;

class BarangRequest extends Request
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
            'kode_barang' => '',
            'nama_barang' => '',
            'harga' => '',
            'kondisi' => '',
            'lokasi_stok' => ''
        ];
        
        return $rules;
    }
}
