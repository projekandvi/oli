<?php

namespace App\Imports;

use App\ImportSO;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class Slip_ordersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ImportSO([
            'id_slip_order'  => $row[0],
            'tanggal'  => $this->transformDate($row[1]),
            'tanggal_upgrade'  => $this->transformDate($row[2]),
            'id_staf'  => Auth::user()->id,
            'id_customer'  => $row[4],
            'no_kartu_customer'  => $row[5],
            'team'  => $row[6],
            'nama_seller'  => $row[7],
            'crc_code'  => $row[8],
            'investor_code'  => $row[9],
            'mesin'  => $row[10],
            'nama_customer'  => $row[11],
            'no_ktp'  => $row[12],
            'alamat_ktp'  => $row[13],
            'alamat_pemasangan'  => $row[14],
            'milik_tempat_tinggal'  => $row[15],
            'no_telp'  => $row[16],
            'no_hp'  => $row[17],
            'email'  => $row[18],
            'tipe_penjualan'  => $row[19],
            'periode_sewa'  => $row[20],
            'nama_pemilik_kartu_recurring'  => $row[21],
            'jenis_bank_recurring'  => $row[22],
            'jenis_kartu_kredit_recurring'  => $row[23],
            'nomor_kartu_recurring'  => $row[24],
            'nominal_debit_recurring'  => $row[25],
            'tanggal_debit_recurring'  => $row[26],
            'masa_kartu_expired_recurring'  => $row[27],
            'ttd_sk_debit'  => $row[28],
            'catatan_recurring'  => $row[29],
            'referensi_invoice'  => $row[30],
            'status_upgrade'  => $row[31],
            'status_pelunasan'  => $row[32],
            'sisa_tagihan'  => $row[33],
            'lokasi_penjualan'  => $row[34],
            'kecamatan'  => $row[35],
            'kab_kot'  => $row[36],
            'provinsi'  => $row[37],
            'total_cart'  => $row[38],
            'remark'  => $row[39],
            'status_pemasangan'  => $row[40],
            'status_recurring'  => $row[41],
            'sp'  => $row[42],
            'sp_dikeluarkan'  => $row[43],
            'sp_ditandatangani'  => $row[44],
            'kelengkapan'  => $row[45],
            'status_sewa'  => $row[46],
            'tarikan_barang'  => $row[47],
            'tempo_maintenance'  => $this->transformDate($row[48]),
            'habis_kontrak'  => $this->transformDate($row[49]),
            'biaya_transportasi'  => $row[50],
            'metode_input'  => $row[51],
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
