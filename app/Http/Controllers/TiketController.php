<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use App\Customer;
use App\SlipOrder;
use App\User;
use App\Http\Requests\TiketRequest;
use Carbon\Carbon;

class TiketController extends Controller
{
    private $searchParams = ['customer','from','to'];

    public function getIndex(Request $request){
        
        $customers =  Customer::orderBy('nama_customer', 'asc')
                            ->pluck('nama_customer', 'id');

        $tikets = Tiket::with('customer')->orderBy('id', 'asc');        
        
        if($request->get('customer')) {
            $tikets->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $tikets->whereBetween('created_at',[$from,$to]);
            }else{
                $tikets->where('created_at','<=',$to);
            }
        }
        return view('tiket.indexTiket')->withTikets($tikets->paginate(20))->withCustomers($customers);
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('TiketController@getIndex', $params);
    }

    public function postIndexTiketPerminggu(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('TiketController@getIndex', $params);
    }
    
    public function updateTiket(Request $request){
        Tiket::where('id',$request->id_tiket)->update([
            'id_staf' =>$request->id_staf
        ]);
        $message = 'changes saved';
        return redirect()->route('tiket.index')->withMessage($message);
    }

    public function getNewTiket () {
        $so = SlipOrder::pluck('id_slip_order');        
        return view('tiket.formTiket', compact('so'));
    }

    public function postTiket(TIketRequest $request, Tiket $tiket){
        $so = SlipOrder::where('id_slip_order',$request->get('id_slip_order'))->first();

        $tiket->id_slip_order = $request->get('id_slip_order');
        $tiket->author = $request->get('author');
        $tiket->id_customer = $so->id_customer;
        $tiket->subyek = $request->get('subyek');
        $tiket->kategori = $request->get('kategori');
        $tiket->prioritas = $request->get('prioritas');
        $tiket->pesan = $request->get('pesan');
        $tiket->save();

        $message = 'Data Saved';
        return redirect()->route('tiket.index')->withMessage($message);
    }

    public function APIStoreTiket(Request $request){
        
        $current_time = Carbon::now('Asia/Jakarta');

        $data['id_slip_order'] = $request->id_slip_order;
        $data['id_staf'] = $request->id_staf;
        $data['id_customer'] = $request->id_customer;
        $data['subyek'] = $request->subyek;
        $data['nama_departemen'] = $request->nama_departemen;
        $data['prioritas'] = $request->prioritas;
        $data['pesan'] = $request->pesan;
        $data['created_at'] = $current_time;       

        Tiket::insert($data);

        return  response()->json([
            'data' => $data,
            'code' => '1',    
        ], 200);
    }

    public function getEditTiket(Tiket $tiket) { 
        $staf = User::where('status','STAFF CUSTOMER SERVICE')->get(); 
        return view('tiket.formTiketUpdate',compact('staf'))->withTiket($tiket);
    }

    public function getTiketDetails(Tiket $tiket){   
        return view('tiket.details')->withTiket($tiket);
    }

    public function deleteTiket(Tiket $tiket){
        $tiket->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
    }
}
