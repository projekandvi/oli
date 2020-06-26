<?php

namespace App\Imports;

use App\Sales;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Sales([
            'id'  => $row[0],
            'id_manajer'  => $row[1],
            'nama_sales'  => $row[2]
        ]);
    }
}
