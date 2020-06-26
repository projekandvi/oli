<?php

namespace App\Imports;

use App\Customer;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'id'  => $row[0],
            'nama_customer'  => $row[1],
            'jenis_kelamin'  => $row[2],
            'tanggal_lahir'  => $this->transformDate($row[3]),
            'kewarganegaraan'  => $row[4],
            'alamat_ktp'  => $row[5],
            'alamat_pemasangan'  => $row[6],
            'no_telp'  => $row[7],
            'no_hp'  => $row[8],
            'no_hp2'  => $row[9],
            'no_ktp'  => $row[10],
            'crc_code'  => $row[11],
            'email'  => $row[12],
            'keluarga'  => $row[13],
            'hp_keluarga'  => $row[14],
            'password'  => Hash::make('123456'),
            'metode_input'  => $row[16]
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
