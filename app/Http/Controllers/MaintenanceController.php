<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance;
use App\Customer;
use App\User;
use App\SlipOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MaintenancesImport;

class MaintenanceController extends Controller
{
    private $searchParams = ['customer','from','to'];

    public function getIndex(Request $request){
        // $now = Carbon::now()->format('Y-m-d');
        // $week = Carbon::now()->addWeek();
        // $month=Carbon::now()->addMonth(60)->format('Y-m-d');
        // $lama = 12;
        // $nyoba = Carbon::parse($lama)->addMonth(3)->format('Y/m/d')
        // dd($nyoba);
        // $bulanya=(Carbon::now()->addMonth()->format('m')) - 1;
        // $waktu=Maintenance::where("tanggal_perbaikan","=", $month)->get();
        // $waktu=Maintenance::whereMonth('tanggal_perbaikan', $bulanya)->get();
        // dd($waktu);

        $teknisi =  User::where('status','=','teknisi')->orderBy('email', 'asc')->pluck('email', 'id');
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $maintenance = Maintenance::orderBy('id', 'asc');        
        
        if($request->get('customer')) {
            $maintenance->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }       

        if($request->get('from') || $request->get('to')) {
            if(!is_null($request->get('from'))){
                $from = Carbon::createFromFormat('Y-m-d',$request->get('from'))->subDays(1)->format('Y/m/d');
                $to = $request->get('to')?:date('Y/m/d');
                $to = Carbon::createFromFormat('Y-m-d',$to)->format('Y/m/d');                
                $maintenance->whereBetween('tanggal_perbaikan',[$from,$to]);
            }else{
                $maintenance->where('tanggal_perbaikan','<=',$to);
            }
        }
        return view('maintenance.indexMaintenance')->withMaintenance($maintenance->paginate(20))->withCustomers($customers)->withTeknisi($teknisi);
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('MaintenanceController@getIndex', $params);
    }
    
    public function postIndexMaintenancePerminggu(Request $request) 
    {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('MaintenanceController@getIndex', $params);
    }

    public function inputTeknisiMaintenance($id_sales_order) 
    {   
        $maintenance = Maintenance::where('id_slip_order','=',$id_sales_order)->first();
        return view('maintenance.formInputTeknisi',compact('maintenance'));
    }

    public function ubahJadwalMaintenance($id_sales_order) 
    {   
        $maintenance = Maintenance::where('id_slip_order','=',$id_sales_order)->first();
        return view('maintenance.formUbahJadwalMaintenance',compact('maintenance'));
    }

    public function simpanInputTeknisiMaintenance(Request $request)
    {
        if ($request->tanggal_pemasangan != null || $request->teknisi != null) {
            Maintenance::where('id',$request->id_rubah)->update([
                'teknisi' =>$request->teknisi
            ]);
            $message = 'changes saved';
            return back()->withInput()->withMessage($message);
        } else {
            $message = 'nothing changes';
            return back()->withInput()->withMessage($message);
        }     
    }

    public function simpanUbahJadwalMaintenance(Request $request) {
         Maintenance::where('id',$request->id_rubah)->update([
                'tanggal_perbaikan' =>$request->tanggal_perbaikan
            ]);
            $message = 'changes saved';
            return back()->withInput()->withMessage($message);            
    }

    public function daftarMaintenanceTempo(){
        $bulannya = (Carbon::now()->addMonth()->format('m')) - 1;
        $tahunnya = Carbon::now()->format('Y');
        $reminder = SlipOrder::whereMonth('tempo_maintenance', $bulannya)->whereYear('tempo_maintenance', $tahunnya)->get();
        return view('maintenance.indexTempoMaintenance',compact('reminder'));
    }

    public function getImportMaintenance(){
        return view('maintenance.formImportMaintenance');
    }

    public function postImportMaintenance(Request $request) {
        Excel::import(new MaintenancesImport, $request->file('unggahan'));

        $message = 'Upload Success';
        echo $message;
        // return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }

    
}
