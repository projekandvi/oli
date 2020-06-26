<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Invoice;

class InvoiceRequest extends Request
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
            'id_invoice' => '',
            'tanggal' => '',
            'id_staf' => '',
            'id_customer' => '',
            'team' => '',
            'nama_seller' => '',
            'lokasi' => '',
            'crc_code' => '',
            'la_code' => '',
            'nama_customer' => '',
            'no_ktp' => '',
            'alamat_ktp' => '',
            'alamat_pemasangan' => '',
            'milik_tempat_tinggal' => '',
            'no_hp' => '',
            'no_telp' => '',
            'email' => '',
            'harga' => '',
            'pembayaran' => '',
            'jenis_bank' => '',
            'nominal_pembayaran' => '',
            'tipe_penjualan' => '',
            'nama_pemilik_kartu_recurring' => '',
            'jenis_bank_recurring' => '',
            'jenis_kartu_kredit_recurring' => '',
            'nomor_kartu_kredit_recurring' => '',
            'nominal_debit_recurring' => '',
            'tanggal_debit_recurring' => '',
            'masa_kartu_expired_recurring' => '',
            'id_barang' => '',
            'pembayaran_terkini' => ''
        ];
        
        return $rules;
    }
}
