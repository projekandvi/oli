<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\Imports\PembayaransImport;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    public function getImportPembayaran(){
        return view('pembayaran.formImportPembayaran');
    }

    public function postImportPembayaran(Request $request) {
        Excel::import(new PembayaransImport, $request->file('unggahan'));

        $message = 'Upload Success';
        echo $message;
        // return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
}
