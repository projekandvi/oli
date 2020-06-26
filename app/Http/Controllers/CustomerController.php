<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Pembayaran;
use App\SlipOrder;
use App\Instalasi;
use App\Maintenance;
use App\LaporanTeknisi;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    private $searchParams = ['customer'];

    public function getIndex(Request $request){       
        $cus =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $customers = Customer::orderBy('id', 'asc');
        $idTerakhir = Customer::latest('id')->first();
        // dd($idTerakhir->id);

        // if ($idTerakhir === null) {
        //     $idTerakhir = ['id' => 1];
        // }
        
        
        if($request->get('customer')) {
            $customers->where('id', 'LIKE', '%' . $request->get('customer') . '%');
        }
        return view('customer.indexCustomer',compact('idTerakhir'))->withcustomers($customers->paginate(20))->withCus($cus);
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('CustomerController@getIndex', $params);
    }

    public function getNewCustomer () {
        $customer = new Customer;
        return view('customer.form', compact('customer'));
    }

    public function postCustomer(Request $request){
        // $this->validate($request, [
        //     'nama_customer' => 'required|max:255',
        //     'jenis_kelamin' => 'required|max:255',
        //     'kewarganegaraan' => 'required|max:255',
        //     'alamat_ktp' => 'required|max:255',
        //     'no_hp' => 'required|max:255',
        //     'no_ktp' => 'required|max:255',
        // ]);
        $customer = Customer::create([
        'child_fullname' => $request->get('child_fullname'),
        'child_username' => $request->get('child_username'),
        'child_gender' => $request->get('child_gender'),
        'child_birthday' => $request->get('child_birthday'),
        'parent_fullname' => $request->get('parent_fullname'),
        'parent_gender' => $request->get('parent_gender'),
        'password' => Hash::make($request->get('password')),
        'parent_email' => $request->get('parent_email'),        
        'parent_phone' => $request->get('parent_phone'),
        'address' => $request->get('address'),
        'country' => $request->get('country'),
        'province' => $request->get('province'),        
        'city' => $request->get('city'),    
        'district' => $request->get('district'),    
        'sub_district' => $request->get('sub_district'),    
        'postal_code' => $request->get('postal_code'),    

        ]);

        $output=array( "code" => "200", "msg" => 'berhasil masuk database');
            echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));

        // $message = 'changes saved';
        // return redirect()->route('customer.index')->withMessage($message);
    }

    public function getEditCustomer(Customer $customer){   
        return view('customer.form')->withCustomer($customer);  
    }

    public function getCustomerDetails($id){   
        $customer = Customer::where('id','=',$id)->first();
        $so = SlipOrder::where('id_customer','=',$customer->id)->first();
        // dd($so);
        if ($so != null) {
            $instalasi = Instalasi::where('id_customer','=',$customer->id)->first();
            $maintenance = Maintenance::where('id_customer','=',$customer->id)->get();
            $laporan =  LaporanTeknisi::where('id_slip_order','=',$instalasi->id_slip_order)->orderBy('id', 'asc')->get();
        }else{
            $instalasi = null;
            $maintenance = null;
            $laporan = null;
        }
        
        
        return view('customer.details',compact('instalasi','maintenance','laporan','so'))->withCustomer($customer);
    }

    public function deleteCustomer(Customer $customer){
        $customer->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
    }

    function masuk(Request $request){
        $data = Customer::where('no_hp','=',$request->no_hp)->first();
          
          if ($data != null){
            $pw = $request->password;
            if (Hash::check($pw, $data->password))
            {
                return response()->json([  
                    'code'=>'200', 
                    'message'=>'Selamat Datang', 
                    'id_customer'=> $data->id, 
                    'nama_customer'=> $data->nama_customer, 
                ]);
            }else {
                return response()->json([  
                    'code'=>'404', 
                    'message'=>'Password Salah', 
                ]);
            }
          }else {
             return response()->json([  
                'code'=>'404', 
                'message'=>'No HP salah', 
            ]);
          }
    }
    
    function tagihan(Request $request){
        $bayar = Pembayaran::where('id_customer','=',$request->id_customer)->latest('created_at')->first();

        if ($bayar != null) {
            $inv = SlipOrder::where('id_customer','=',$request->id_customer)->where('tipe_penjualan','=','Sewa')->latest('created_at')->first();
            $terakhirBayar = $bayar->created_at->format('m');            
            $now = Carbon::now();
            $bulanIni = $now->format('m');
    
            if ($terakhirBayar === $bulanIni) {
                return response()->json([  
                    'code'=>'200', 
                    'status'=>'1', 
                    'tagihan'=>'',
                    'message'=>'anda telah melakukan pembayaran bulan ini', 
                    ]);
            } else {
                return response()->json([  
                    'code'=>'200', 
                    'status'=>'2', 
                    'tagihan'=>'Rp. 600.000', 
                    'message'=> $inv->tanggal_debit_recurring.$now->format(' F Y'), 
                    ]);
            }
        } else {
             return response()->json([  
                    'code'=>'200', 
                    'status'=>'3',
                    'tagihan'=>'', 
                    'message'=> 'Belum ada Tagihan', 
                    ]);
        }
        
    }

    function daftarTransaksi(Request $request){
        $jsonObj= array();
        $daftar = SlipOrder::where('id_customer','=', $request->id_customer)->get();

        foreach($daftar as $data){			
			$row['id_slip_order'] = $data['id_slip_order'];
			$row['tanggal'] = $data['tanggal'];              
			array_push($jsonObj,$row);		
        }

        return \Response::json(array(
            // 'error'     =>  false,
            'daftar'    =>  $jsonObj),
            200
        );
    }


    function riwayatTagihan(Request $request){
        $jsonObj= array();
        $riwayat = SlipOrder::where('id_customer','=', $request->id_customer)->get();
        $bayar = Pembayaran::where('id_slip_order','=',$request->id_slip_order)->get();
        
        foreach($bayar as $data){
			$row['jenis_bank'] = $data['jenis_bank'];
			$row['jenis_kartu_kredit'] = $data['jenis_kartu_kredit'];
 			$row['nomor_kartu'] = $data['nomor_kartu'];
 			$row['tanggal_debit'] = $data['tanggal_debit'];
 			$row['masa_kartu_expired'] = $data['masa_kartu_expired'];
 			$row['nominal_pembayaran'] = $data['nominal_pembayaran'];               
			array_push($jsonObj,$row);		
        }
        return \Response::json(array(
            'pembayaran'    =>  $jsonObj),
            200
        );
    }
    
    public function getTarikanBarang(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $so =  SlipOrder::where('tipe_penjualan','not like','%Putus%')->where('tarikan_barang','=','FALSE')->orderBy('id_slip_order', 'asc')->pluck('id_slip_order', 'id_slip_order');
        $sewa = SlipOrder::where('tipe_penjualan','not like','%Putus%')->where('tarikan_barang','=','TRUE')->orderBy('id_slip_order', 'asc');        
        
        if($request->get('slip_order_no')) {
            $sewa->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $sewa->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('from') || $request->get('to')) {
            if(!is_null($request->get('from'))){
                $from = Carbon::parse($request->get('from'))->format('Y-m-d') . ' 00:00:01';
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $sewa->whereBetween('created_at',[$from,$to]);
            }else{
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $sewa->where('tanggal','<=',$to);
            }
        }

        return view('customer.indexTarikanBarang')->withSewa($sewa->paginate(10))->withCustomers($customers)->withSo($so);
    }

    public function postIndexSewaRecurring(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewaRecurring', $params);
    }

    public function simpanTarikanBarang(Request $request){
        SlipOrder::where('id_slip_order',$request->id_slip_order)->update([
                'tarikan_barang' => 'TRUE',
                'remarks_tarikan' => $request->remarks
            ]);
            $message = 'changes saved';
            return back()->withInput()->withMessage($message);            
    }

    
    public function getProduct($id){
        $products = Customer::findOrFail($id);
        return response()->json($products, 200);
    }

    public function getImportCustomer(){
        return view('customer.formImportCustomer');
    }

    public function postImportCustomer(Request $request) {
        // dd($request->file('unggahan'));
        Excel::import(new CustomersImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('customer.index')->withMessage($message);
    }

    public function getIndexDataTarikan(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $so =  SlipOrder::where('tipe_penjualan','not like','%Putus%')->where('tarikan_barang','=','FALSE')->orderBy('id_slip_order', 'asc')->pluck('id_slip_order', 'id_slip_order');
        $sewa = SlipOrder::where('tipe_penjualan','not like','%Putus%')->where('tarikan_barang','=','TRUE')->orderBy('id_slip_order', 'asc');        
        
        if($request->get('slip_order_no')) {
            $sewa->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $sewa->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('from') || $request->get('to')) {
            if(!is_null($request->get('from'))){
                $from = Carbon::parse($request->get('from'))->format('Y-m-d') . ' 00:00:01';
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $sewa->whereBetween('created_at',[$from,$to]);
            }else{
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $sewa->where('tanggal','<=',$to);
            }
        }

        return view('customer.indexDataTarikanBarang')->withSewa($sewa->paginate(10))->withCustomers($customers)->withSo($so);
    }
    
}
