<?php

namespace App\Imports;

use App\LaporanTeknisi;
use Maatwebsite\Excel\Concerns\ToModel;

class LaporanTeknisiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LaporanTeknisi([
            'id_slip_order'  => $row[0],
            'kunjungan'  => $row[1],
            'tanggal_laporan'  => $this->transformDate($row[2]),
            'id_teknisi'  => $row[3],
            'sumber_air'  => $row[4],
            'tds_sumber'  => $row[5],
            'tds_lv1'  => $row[6],
            'tds_lv2'  => $row[7],
            'tds_lv3'  => $row[8],
            'tds_lv4'  => $row[9],
            'tds_lv5'  => $row[10],
            'tds_lv6'  => $row[11],
            'ph_sumber'  => $row[12],
            'ph_lv1'  => $row[13],
            'ph_lv2'  => $row[14],
            'ph_lv3'  => $row[15],
            'ph_lv4'  => $row[16],
            'ph_lv5'  => $row[17],
            'ph_lv6'  => $row[18],
            'metode_input'  => $row[19],
            'keterangan'  => $row[20],
            'id_maintenance'  => $row[21],
            'id_instalasi'  => $row[22]            
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
