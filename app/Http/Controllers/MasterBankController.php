<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBank;
use App\Imports\MasterBanksImport;
use Maatwebsite\Excel\Facades\Excel;

class MasterBankController extends Controller
{
    public function getImportMasterBank(){
        return view('masterBank.formImportMasterBank');
    }

    public function postImportMasterBank(Request $request) {
        Excel::import(new MasterBanksImport, $request->file('unggahan'));

        $message = 'Upload Success';
        echo $message;
        // return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
}
