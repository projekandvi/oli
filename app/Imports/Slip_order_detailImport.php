<?php

namespace App\Imports;

use App\SlipOrderDetail;
use Maatwebsite\Excel\Concerns\ToModel;

class Slip_order_detailImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SlipOrderDetail([
            'id_slip_order'  => $row[0],
            'kode_barang'  => $row[1],
            'id_barang'  => $row[2],
            'nama_barang'  => $row[3],
            'harga'  => $row[4],
            'qty'  => $row[5],
            'metode_input'  => $row[6]
        ]);
    }
}
