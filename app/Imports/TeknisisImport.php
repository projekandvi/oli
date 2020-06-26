<?php

namespace App\Imports;

use App\Teknisi;
use Maatwebsite\Excel\Concerns\ToModel;

class TeknisisImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teknisi([
            'id'  => $row[0],
            'nama_teknisi'  => $row[1]
        ]);
    }
}
