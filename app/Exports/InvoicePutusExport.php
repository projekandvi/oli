<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicePutusExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($invoice_no,$customer,$dari,$ke,$tanggal_otomatis,$headings)
    {
        $this->invoice_no = $invoice_no;
        $this->customer = $customer;
        $this->dari = $dari;
        $this->ke = $ke;
        $this->tanggal_otomatis = $tanggal_otomatis;
        $this->headings = $headings;
    }
    public function collection()
    {
        return Invoice::select('id_invoice','nama_customer')->whereBetween('created_at', [$this->dari.' 00:00:00',$this->ke.' 23:59:59'])->get();
    }

    public function headings() : array
    {
        return $this->headings;
    }
}
