<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\SlipOrder;
use App\LaporanTeknisi;
use App\Instalasi;
use Carbon\Carbon;
use App\Imports\LaporanTeknisiImport;
use App\Imports\TeknisisImport;
use Maatwebsite\Excel\Facades\Excel;

class TeknisiController extends Controller
{
    private $searchParams = ['slip_order_no','customer'];

    public function getIndex(Request $request){   
         
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $slipOrder =  SlipOrder::orderBy('id_slip_order', 'asc')->pluck('id_slip_order','id_slip_order');
        $so = SlipOrder::orderBy('id_slip_order', 'asc');        
        
        if($request->get('slip_order_no')) {
            $so->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $so->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        
        return view('teknisi.indexTeknisi')
        ->withSo($so->paginate(10))
        ->withCustomers($customers)
        ->withSlipOrder($slipOrder);
    }

    public function postIndex(Request $request){
        if ($request->get('slip_order_no') != null) {
            $params = 'slip_order_no='.$request->get('slip_order_no');
        } 
        elseif ($request->get('customer') != null) {
            $params = 'customer='.$request->get('customer');
        }
        else{
            $params = array_filter($request->only($this->searchParams));
        }
        
        return redirect()->action('TeknisiController@getIndex', $params);
    }

    public function getLaporanTeknisi(Request $request){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->where('id_slip_order','=',$request->id_slip_order)->first();
        $laporan =  LaporanTeknisi::where('id_slip_order',$request->id_slip_order)->orderBy('id', 'asc')->get();
        return view('teknisi.laporanTeknisi',compact('so','laporan'));
    }

    public function storeLaporanTeknisi(Request $request){

        $this->validate($request, [
            'id_slip_order' => 'required|max:255',
            'tanggal_laporan' => 'required|max:255',
            'tds_sumber' => 'required|max:255',
            'tds_lv1' => 'required|max:255',
        ]);
        
        $laporan = LaporanTeknisi::create([
            'id_slip_order' =>  $request->id_slip_order,
            'kunjungan' =>  $request->kunjungan,
            'tanggal_laporan' =>  $request->tanggal_laporan,
            'tds_sumber' =>  $request->tds_sumber,
            'tds_lv1' =>  $request->tds_lv1,
            'tds_lv2' =>  $request->tds_lv2,
            'tds_lv3' =>  $request->tds_lv3,
            'tds_lv4' =>  $request->tds_lv4,
            'tds_lv5' =>  $request->tds_lv5,
            'tds_lv6' =>  $request->tds_lv6,
            'ph_sumber' =>  $request->ph_sumber,
            'ph_lv1' =>  $request->ph_lv1,
            'ph_lv2' =>  $request->ph_lv2,
            'ph_lv3' =>  $request->ph_lv3,
            'ph_lv4' =>  $request->ph_lv4,
            'ph_lv5' =>  $request->ph_lv5,
            'ph_lv6' =>  $request->ph_lv6,
            'keterangan' =>  $request->keterangan
        ]);
        
        $dataLaporan = LaporanTeknisi::where('id_slip_order',$laporan->id_slip_order)->count();
        $tanggalPlus5Thn = Carbon::parse(Carbon::parse($laporan->tanggal_laporan)->addMonth(60)->format('Y-m-d'));
        if ($dataLaporan === 1) {

            $dataTipePenjualan = SlipOrder::where('id_slip_order',$laporan->id_slip_order)->first();
            if ($dataTipePenjualan->tipe_penjualan === 'Putus') {
                SlipOrder::where('id_slip_order',$laporan->id_slip_order)->update([
                    'tanggal_hak_milik' =>$laporan->tanggal_laporan,
                    'status_pemasangan' =>'Terpasang'
                ]);
            } else {
                SlipOrder::where('id_slip_order',$laporan->id_slip_order)->update([
                    'tanggal_hak_milik' =>$tanggalPlus5Thn,
                    'status_pemasangan' =>'Terpasang'
                ]);
            }

            Instalasi::where('id_slip_order',$laporan->id_slip_order)->update([
                'status_instalasi' => 'Terpasang'
            ]);

        }

        $message = 'data saved';
        return redirect('laporanTeknisi/SO/'.$request->id_slip_order)->withMessage($message);  
    }

    public function getImportLaporanTeknisi(){
        return view('teknisi.formImportLaporanTeknisi');
    }

    public function postImportLaporanTeknisi(Request $request) {
        Excel::import(new LaporanTeknisiImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
    
    public function getImportTeknisi(){
        return view('teknisi.formImportTeknisi');
    }

    public function postImportTeknisi(Request $request) {
        Excel::import(new TeknisisImport, $request->file('unggahan'));

        $message = 'Upload Success';
        
        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }


}
