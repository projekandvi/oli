<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instalasi;
use App\Customer;
use App\User;
use App\Maintenance;
use App\SlipOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InstalasiImport;

class InstalasiController extends Controller
{
    // private $searchParams = ['nama_sparepart'];
    // public function getIndex(Request $request)
    // {
    //     $teknisi =  User::where('status','=','teknisi')->orderBy('email', 'asc')
    //                             ->pluck('email', 'id');

    //     $instalasi = Instalasi::orderBy('id_slip_order', 'asc');
    //     if ($request->get('id_slip_order')) {
    //         $instalasi->where(function($q) use($request) {
    //             $q->where('id_slip_order', 'LIKE', '%' . $request->get('id_slip_order') . '%');
    //         });
    //     }
    //     return view('instalasi.index')->withInstalasi($instalasi->paginate(20))->withTeknisi($teknisi);
    // }

    private $searchParams = ['customer','from','to'];

    public function getIndex(Request $request)
    {
        $teknisi =  User::where('status','=','teknisi')->orderBy('email', 'asc')->pluck('email', 'id');
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $instalasi = Instalasi::where('status_instalasi',null)->orderBy('id', 'asc');        
        
        if($request->get('customer')) {
            $instalasi->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $instalasi->whereBetween('created_at',[$from,$to]);
            }else{
                $instalasi->where('created_at','<=',$to);
            }
        }
        return view('instalasi.indexInstalasiq')->withInstalasi($instalasi->paginate(20))->withCustomers($customers)->withTeknisi($teknisi);
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InstalasiController@getIndex', $params);
    }

    public function postIndexInstalasiPerminggu(Request $request) 
    {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InstalasiController@getIndex', $params);
    }

    public function getDataInstalasi($id){
        $data = Instalasi::where('id','=',$id)->first();
        return view('instalasi.formInputTeknisiInstalasi',compact('data'));
    }

    public function simpanProses(Request $request){
        
        // $this->validate($request, [
        //     'tanggal_pemasangan' => 'required|max:255',
        //     'teknisi' => 'required|max:255',
        // ]);
        // dd($request->all());

        if ($request->tanggal_pemasangan === null) {
            $tanggalPemasangan = $request->tanggal_pemasangan2;
        } else {
            $tanggalPemasangan = $request->tanggal_pemasangan;
        }        

        $tanggalMaintenance = Carbon::parse(Carbon::parse($tanggalPemasangan)->addMonth(3)->format('Y/m/d'));

        $dataInstalasi = Instalasi::where('id','=',$request->id_rubah)->first();

        $dataSO = SlipOrder::where('id_slip_order',$dataInstalasi->id_slip_order)->first();

        if ($dataSO->tipe_penjualan === "SewaRecurring") {
            $tempo_maintenance = Carbon::now()->addMonth(60)->format('Y-m-d'); 
            $tanggalMaintenance = Carbon::parse(Carbon::parse($tanggalPemasangan)->addMonth(60)->format('Y/m/d'));
        } elseif($dataSO->tipe_penjualan === "SewaPeriode") {
            $tempo_maintenance = Carbon::now()->addMonth($dataSO->periode_sewa)->format('Y-m-d'); 
            $tanggalMaintenance = Carbon::parse(Carbon::parse($tanggalPemasangan)->addMonth($dataSO->periode_sewa)->format('Y/m/d'));
        } elseif($dataSO->tipe_penjualan === "SewaPeriode") {
            $tanggalMaintenance = Carbon::parse(Carbon::parse($tanggalPemasangan)->addMonth($dataSO->periode_sewa)->format('Y/m/d'));
        }
        

        if ($request->tanggal_pemasangan != null || $request->teknisi != null) {
            Instalasi::where('id',$request->id_rubah)->update([
                'tanggal_pemasangan' =>$tanggalPemasangan,
                'teknisi' =>$request->teknisi,
                'remark' =>$request->remark,
                'id_staf' =>$request->id_staf
            ]);

            Maintenance::where('id_slip_order',$dataInstalasi->id_slip_order)->update([
                'tanggal_perbaikan' =>$tanggalMaintenance
            ]);

            $message = 'changes saved';
            return redirect('instalasi')->withMessage($message);
        } else {
            $message = 'nothing changes';
            return back()->withInput()->withMessage($message);
        }     
    }

    // public function simpanNewTeknisi(Request $request){
    //     $newTeknisi['nama_teknisi'] =  $request->nama_teknisi;    
    //     Teknisi::create($newTeknisi);
    //     return response()->json(200);
    // }

    public function getIndexDataTerpasang(Request $request)
    {
        $hariIni = Carbon::now()->format('Y-m-d');
        $teknisi =  User::where('status','=','teknisi')->orderBy('email', 'asc')->pluck('email', 'id');
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $instalasi = Instalasi::where('tanggal_pemasangan','<',$hariIni)->orderBy('id', 'asc');        
        
        if($request->get('customer')) {
            $instalasi->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $instalasi->whereBetween('created_at',[$from,$to]);
            }else{
                $instalasi->where('created_at','<=',$to);
            }
        }
        return view('instalasi.indexDataInstalasiTerpasang')->withInstalasi($instalasi->paginate(20))->withCustomers($customers)->withTeknisi($teknisi);
    }

    public function postIndexDataTerpasang(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InstalasiController@getIndexDataTerpasang', $params);
    }

    public function getImportInstalasi(){
        return view('instalasi.formImportInstalasi');
    }

    public function postImportInstalasi(Request $request) {
        Excel::import(new InstalasiImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }

}
