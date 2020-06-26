<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TemporaryInvoice;
use App\Invoice;
use App\Customer;
use Carbon\Carbon;

class TemporaryInvoiceController extends Controller
{
    private $searchParams = ['invoice_no','customer','from','to'];

    public function getIndex(Request $request)
    {   
        $customers =  Customer::orderBy('nama_customer', 'asc')
                                ->pluck('nama_customer', 'id');  
        $temporary = TemporaryInvoice::where('status_pengajuan','=',null)->orderBy('id_invoice', 'asc');          
        // dd($temporary);
        
        if($request->get('invoice_no')) {
            $temporary->where('id_invoice', 'LIKE', '%' . $request->get('invoice_no') . '%');
        }

        if($request->get('customer')) {
            $temporary->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $temporary->whereBetween('tanggal',[$from,$to]);
            }else{
                $temporary->where('tanggal','<=',$to);
            }
        } 

        return view('temporary.slipOrder')
        ->withTemporary($temporary->paginate(10))
        ->withCustomers($customers);
    }

    public function getSlipOrderDetails(TemporaryInvoice $temporary)
    {   
        $asli = Invoice::where('id_invoice','=',$temporary->id_invoice)->first(); 
        return view('temporary.slipOrderDetail')
        ->withAsli($asli)
        ->withTemporary($temporary);
    }

    public function tolak($id)
    {       
        TemporaryInvoice::where('id_invoice',$id)->update([
            'status_pengajuan' => 'DITOLAK',
        ]);        

        $message = 'Data berhasil ditolak';
        return redirect()->route('temporarySO.index')->withMessage($message);
    }
    
    public function terima($id)
    {       
        TemporaryInvoice::where('id_invoice',$id)->update([
            'status_pengajuan' => 'DISETUJUI',
        ]);
        
        $temporary = TemporaryInvoice::where('id_invoice',$id)->first();

        $update = Invoice::where('id_invoice',$id)->first();

        $update->team = $temporary->team;
        $update->nama_seller = $temporary->nama_seller;
        $update->lokasi_penjualan = $temporary->lokasi_penjualan;
        $update->crc_code = $temporary->crc_code;
        $update->la_code = $temporary->la_code;

        $update->save();
        

        $message = 'Data berhasil disetujui';
        return redirect()->route('temporarySO.index')->withMessage($message);
    }

}
