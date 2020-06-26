<?php

namespace App\Imports;

use App\MasterBank;
use Maatwebsite\Excel\Concerns\ToModel;

class MasterBanksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MasterBank([
            'id'  => $row[0],
            'kode_bank'  => $row[1],
            'nama_bank'  => $row[2]
        ]);
    }
}
