<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Imports\SalesImport;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    public function getImportSales(){
        return view('sales.formImportSales');
    }

    public function postImportSales(Request $request) {
        Excel::import(new SalesImport, $request->file('unggahan'));

        $message = 'Upload Success';
        echo $message;
        // return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
}
