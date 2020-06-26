<?php

namespace App\Imports;

use App\SalesManager;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesManagersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SalesManager([
            'id'  => $row[0],
            'nama_manajer'  => $row[1]
        ]);
    }
}
