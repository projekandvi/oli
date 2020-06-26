<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesManager;
use App\Imports\SalesManagersImport;
use Maatwebsite\Excel\Facades\Excel;

class SalesManagerController extends Controller
{
    public function getImportSalesManager(){
        return view('salesManager.formImportSalesManager');
    }

    public function postImportSalesManager(Request $request) {
        Excel::import(new SalesManagersImport, $request->file('unggahan'));

        $message = 'Upload Success';
        echo $message;
        // return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
}
