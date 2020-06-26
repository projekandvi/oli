<?php

namespace App\Imports;

use App\Pembayaran;
use Maatwebsite\Excel\Concerns\ToModel;

class PembayaransImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pembayaran([
            'keterangan_pembayaran'  => $row[1],
            'id_slip_order'  => $row[4],
            'id_customer'  => $row[5],
            'nominal_pembayaran'  => $row[12],
            'metode_input'  => $row[13]
        ]);
    }
}
