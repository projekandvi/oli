<?php

namespace App\Exports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($dari, $ke, $date, $headings)
    {
        $this->dari = $dari;
        $this->ke = $ke;
        $this->date = $date;
        $this->headings = $headings;
    }

    
    public function collection()
    {
        // return Transaction::select('inv','destination_name','customer_name', 'gender', 'region','occupation')->get();
        return Transaction::select('inv','destination_name','customer_name', 'gender', 'region','occupation')->whereBetween('created_at', [$this->dari.' 00:00:00',$this->ke.' 23:59:59'])->get();
    }

    public function headings() : array
    {
        return $this->headings;
    }
}
