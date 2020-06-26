<?php

namespace App\Exports;

use App\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class PerBanksExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($kodeBank, $namaBank, $headings) {
        $this->kodeBank = $kodeBank;
        $this->namaBank = $namaBank;
        $this->headings = $headings;
    }

    public function collection() {
        $hasil = DB::table('pembayarans')
        ->join('master_banks', 'pembayarans.id_bank', '=', 'master_banks.kode_bank')
        ->select('pembayarans.id_bank', 'master_banks.nama_bank', 'pembayarans.id_slip_order', 'pembayarans.keterangan_pembayaran', 'pembayarans.nominal_pembayaran')
        ->where('id_bank','=',$this->kodeBank)
        ->get();
        return $hasil;
    }

    public function headings() : array  {
        return $this->headings;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}
