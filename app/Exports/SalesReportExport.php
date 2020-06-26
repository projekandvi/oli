<?php

namespace App\Exports;

use App\Sales;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class SalesReportExport implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    public function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('staf.laporanPenjualanExcel', [
            'sales' => Sales::where('id_manajer','=',$this->id)->orderBy('nama_sales', 'asc')->get()
        ]);
    }

    // $sheet->setColumnFormat(array(
    //     'D' => 'dd-mm-yyy',
    //     'H' => '@',
    //     'L' => '@'
    // ));

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_PERCENTAGE_00,
        ];
    }

     /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(20);
            },
        ];
    }
}
