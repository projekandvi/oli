<?php

namespace App\Imports;

use App\Maintenance;
use Maatwebsite\Excel\Concerns\ToModel;

class MaintenancesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Maintenance([
            'id'  => $row[0],
            'id_slip_order'  => $row[1],
            'id_customer'  => $row[2],
            'tanggal_perbaikan'  => $this->transformDate($row[3]),
            'id_teknisi'  => $row[4],
            'tindakan'  => $row[5],
            'biaya_kunjungan'  => $row[6],
            'metode_input'  => $row[7],
            'keterangan'  => $row[8],
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
