<?php

namespace App\Imports;

use App\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'id_barang'  => $row[0],
            'kode_barang'  => $row[1],
            'nama_barang'  => $row[2]
        ]);
    }
}
