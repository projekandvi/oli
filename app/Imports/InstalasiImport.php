<?php

namespace App\Imports;

use App\Instalasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class InstalasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Instalasi([
            'id'  => $row[0],
            'kode_instalasi'  => $row[1],
            'id_slip_order'  => $row[2],
            'id_barang'  => $row[3],
            'nama_barang'  => $row[4],
            'id_customer'  => $row[5],
            'tanggal_pemasangan'  => $this->transformDate($row[6]), 
            'teknisi'  => $row[8],
            'status_instalasi'  => $row[9],
            'metode_input'  => $row[10],
        ]);
    }

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
