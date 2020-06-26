<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryOrder;
use App\DeliveryOrderDetail;
use App\Customer;
use App\Invoice;
use App\LokasiBarang;
use App\Barang;
use App\Http\Requests\DeliveryOrderRequest;
use DB;
use Carbon\Carbon;
use Auth;

class DeliveryOrderController extends Controller
{
    
    private $searchParams = ['customer','from','to'];

    public function getIndex(Request $request){
        
        $customers =  Customer::orderBy('nama_customer', 'asc')
                            ->pluck('nama_customer', 'id');

        $deliverys = DeliveryOrder::with('usernya')->orderBy('updated_at', 'asc');        
        
        if($request->get('customer')) {
            $deliverys->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $deliverys->whereBetween('created_at',[$from,$to]);
            }else{
                $deliverys->where('created_at','<=',$to);
            }
        } 

        return view('delivery.indexDO')->withDeliverys($deliverys->get())->withCustomers($customers);
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('DeliveryOrderController@getIndex', $params);
    }

    public function postIndexDeliveryPerminggu(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('DeliveryOrderController@getIndex', $params);
    }

    public function getNewDelivery () {
        $delivery = new DeliveryOrder;
        $invoices = Invoice::get();
        return view('delivery.form', compact('delivery','invoices'));
    }

    public function postDelivery(DeliveryOrderRequest $request, DeliveryOrder $delivery) {
        $delivery->id_do = $this->autonumber();
        $delivery->tanggal = $request->get('tanggal');
        $delivery->id_invoice = $request->get('id_invoice');
        $delivery->id_staf = $request->get('id_staf');
        $delivery->save();

        $message = 'changes saved';
        return redirect()->route('delivery.preview',$delivery->id_do)->withMessage($message);

    }

    public function simpanProses(Request $request){
        $this->validate($request, [
            'lokasi_keluar_barang' => 'required'
        ]);

        $delivery = DeliveryOrderDetail::where('id',$request->id)->first();
        
        if ($request->barcode1 != null) {
            DeliveryOrderDetail::where('id',$request->id)->update([
                'barcode1' =>$request->barcode1,
                'barcode2' =>$request->barcode2,
                'barcode3' =>$request->barcode3,
                'barcode4' =>$request->barcode4,
                'barcode5' =>$request->barcode5,
                'lokasi_keluar_barang' =>$request->lokasi_keluar_barang,
            ]);            
           
            //pengurangan master barang
            $barang = Barang::where('id_barang','=',$delivery->id_barang)->first();
            $barang->stok = $barang->stok - $delivery->qty;
            $barang->save();

            //pengurangan sesuai gudang barang
            $lokasiBarang = LokasiBarang::where('id_barang','=',$delivery->id_barang)->first();
            $lokasiBarang->stok = $lokasiBarang->stok - $delivery->qty;
            $lokasiBarang->save();

            //input id staf
            $namaPetugas = DeliveryOrder::where('id_do','=',$request->id_do)->first();
            $namaPetugas->id_staf = Auth::user()->id;
            $namaPetugas->save();

            $message = 'changes saved';
            return back()->withInput()->withMessage($message);
        } else {
            $message = 'nothing changes';
            return back()->withInput()->withMessage($message);
        }
    }

    public function getDeliveryPreview($delivery){
        $del = DeliveryOrder::where('id_do','=',$delivery)->first();   
        return view('delivery.preview',compact('del'));
    }

    public function getProsesDelivery(DeliveryOrder $delivery){  
        $DOD = DeliveryOrderDetail::where('id_do','=',$delivery->id_do)->first();
        
        $lokasi = LokasiBarang::where('id_barang','=',$DOD->id_barang)->get();
        
        return view('delivery.prosesDelivery',compact('lokasi'))
                ->withDo($delivery);
    }

    public function cetakDO($id){
        $do = DeliveryOrder::with('deliveryOrderDetail')->where('id_do','=',$id)->first();
        $tanggalan = Carbon::now()->format('d-m-Y');
        // dd($pembayaran);
        return view('delivery.printerDO',compact('do','tanggalan'));
    }

    
    public static function autonumber(){
        $q=DB::table('delivery_orders')->select(DB::raw('MAX(RIGHT(id_do,5)) as kd_max'));
        $prx='DO-';
        if($q->count()>0){
            foreach($q->get() as $k) {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%05s", $tmp);
            }
        }
        else {
            $kd = $prx."00001";
        }
        return $kd;
    }
}
