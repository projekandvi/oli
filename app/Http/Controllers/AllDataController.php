<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\SlipOrder;
use App\Instalasi;
use App\SalesManager;
use App\Sales;
use App\LaporanTeknisi;
use Carbon\Carbon;

class AllDataController extends Controller
{
    private $searchParams = ['slip_order_no','customer','from','to','manajer','periode_sewa'];

    public function getIndex(Request $request){ 
        $hariIni = Carbon::now()->format('Y-m-d');
        // menampilkan data 
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $allData = SlipOrder::where('metode_input','=','import')
            ->with('customer')
            ->with('bank')
            // ->with(['instalasi.tek' => function ($query) {
            //     $query->select('nama_teknisi');
            //     }])
            ->orderBy('tanggal', 'asc');  
                      
        
        if($request->get('slip_order_no')) {
            $allData->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $allData->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('manajer')) {
            $allData->where('team', 'LIKE', '%' . $request->get('manajer') . '%');
        }

        if($request->get('from') || $request->get('to')) {
            if(!is_null($request->get('from'))){
                $from = Carbon::parse($request->get('from'))->format('Y-m-d') . ' 00:00:01';
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $allData->whereBetween('created_at',[$from,$to]);
            }else{
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $allData->where('tanggal','<=',$to);
            }
        } 
        
        $cloneTransactionForNetTotal = clone $allData;
        $net_total = $cloneTransactionForNetTotal->sum('total_cart');

        return view('allData.indexAllData',compact('hariIni'))
        ->withAllData($allData->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndex(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('AllDataController@getIndex', $params);
    }

    public function laporanInstalasi(){
        $params = Instalasi::with('laporanTeknisiInstalasi')->get();
        return view('laporInstalasi',compact('params'));
    }

    public function allDataDetail(Request $request){
        $SO = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        // dd($SO);    
        return view('allData.indexAllDataDetail',compact('SO'));                 
    }


    public function simpanUbahAllData(Request $request){
        // dd($request->id_slip_order);

        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $so->tanggal = $request->satu;
        $so->tanggal_upgrade = $request->dua;
        $so->id_slip_order = $request->tiga;
        $so->nama_customer = $request->empat; // ada id nya
        $so->alamat_pemasangan = $request->tujuh;
        $so->crc_code = $request->empatbelas;
        $so->investor_code = $request->limabelas;
        $so->lokasi_penjualan = $request->enambelas;
        $so->kecamatan = $request->tujuhbelas;
        $so->kab_kot = $request->delapanbelas;
        $so->provinsi = $request->sembilanbelas;
        $so->tipe_penjualan = $request->duapuluhtiga;
        $so->nama_pemilik_kartu_recurring = $request->duapuluhempat;
        $so->jenis_kartu_kredit_recurring = $request->duapuluhenam;
        $so->jenis_bank_recurring = $request->duapuluhtujuh;
        $so->nomor_kartu_recurring = $request->duapuluhdelapan;
        $so->tanggal_debit_recurring = $request->duapuluhsembilan;
        $so->ttd_sk_debit = $request->tigapuluh;
        if ($request->tigapuluhsatu != null) {
            $so->tempo_maintenance = $request->tigapuluhsatu;
        } elseif ($request->tigapuluhdua != null) {
            $so->tempo_maintenance = $request->tigapuluhdua;
        }  
        
        
        $so->remark = $request->limapuluhdua;
        $so->total_cart = $request->limapuluhtiga;
        $so->sisa_tagihan = $request->limapuluhenam;
        $so->sp = $request->limapuluhtujuh;
        $so->sp_dikeluarkan = $request->limapuluhdelapan;
        $so->sp_ditandatangani = $request->limapuluhsembilan;
        $so->kelengkapan = $request->enampuluh;
        $so->status_sewa = $request->enampuluhsatu;
        $so->status_pemasangan = $request->enampuluhdua;
        $so->tanggal_tarik_barang = $request->enampuluhtiga;
        $so->habis_kontrak = $request->enampuluhempat;
        $so->no_kartu_customer = $request->enampuluhlima;
        $so->biaya_transportasi = $request->enampuluhenam;
        $so->save(); 

        // tabel Slip Order
        


        // tabel customer 
        $customer = Customer::where('id','=',$request->id_customer)->first();
        $customer->tanggal_lahir = $request->lima;
        $customer->kewarganegaraan = $request->enam;
        $customer->no_telp = $request->delapan;
        $customer->no_hp = $request->sembilan;
        $customer->no_hp2 = $request->sepuluh;
        $customer->no_ktp = $request->sebelas;        
        $customer->save(); 
        
        if ($request->duabelas != null) {
            // tabel sales manager
            $tabel_manager = SalesManager::where('id','=',$request->duabelas)->first();
            $tabel_manager->manager = $request->duabelas;
            $tabel_manager->save(); 
        }
        


        // tabel sales 
        $tabel_sales = Sales::where('id_','=',$request->tigabelas)->first();       
        $tabel_sales->sales = $request->tigabelas;
        $tabel_sales->save(); 

        // tabel slip order detail
        $soDetail = SlipOrderDetail::where('id_slip_order','=',$request->id_slip_order)->first();
        $soDetail->mesin = $request->duapuluh;
        $soDetail->mesin_terpasang = $request->duapuluhsatu;  
        $soDetail->save();        
       
        
       
        // $filter_tambahan = $request->duapuluhdua;

        // tabel master bank
        $tabel_bank = Sales::where('id_','=',$request->duapuluhlima)->first();       
        $tabel_bank->nama_bank = $request->duapuluhlima;        
        $tabel_bank->save();
        
       
        // tabel instalasi
        $instalasi = Instalasi::where('id_slip_order','=',$request->id_slip_order)->first();
        $instalasi->tanggal_pemasangan1 = $request->tigapuluhtiga;
        $instalasi->tanggal_pemasangan2 = $request->tigapuluhempat;
        $instalasi->teknisi_pemasangan = $request->tigapuluhlima;
        $instalasi->no_pemasangan = $request->tigapuluhenam;
        $instalasi->save();

        // tabel laporan instalasi
        $laporan_teknisi_instalasi = LaporanTeknisi::where('id_slip_order','=',$request->id_slip_order)->first();
        $laporan_teknisi_instalasi->sumber_air_pemasangan = $request->tigapuluhtujuh;
        $laporan_teknisi_instalasi->tds_sebelum_pemasangan = $request->tigapuluhdelapan;
        $laporan_teknisi_instalasi->tds_lv1_pemasangan = $request->tigapuluhsembilan;
        $laporan_teknisi_instalasi->tds_lv2_pemasangan = $request->empatpuluh;
        $laporan_teknisi_instalasi->tds_lv3_pemasangan = $request->empatpuluhsatu;
        $laporan_teknisi_instalasi->tds_lv4_pemasangan = $request->empatpuluhdua;
        $laporan_teknisi_instalasi->tds_lv5_pemasangan = $request->empatpuluhtiga;
        $laporan_teknisi_instalasi->tds_lv6_pemasangan = $request->empatpuluhempat;
        $laporan_teknisi_instalasi->ph_sebelum_pemasangan = $request->empatpuluhlima;
        $laporan_teknisi_instalasi->ph_lv1_pemasangan = $request->empatpuluhenam;
        $laporan_teknisi_instalasi->ph_lv2_pemasangan = $request->empatpuluhtujuh;
        $laporan_teknisi_instalasi->ph_lv3_pemasangan = $request->empatpuluhdelapan;
        $laporan_teknisi_instalasi->ph_lv4_pemasangan = $request->empatpuluhsembilan;
        $laporan_teknisi_instalasi->ph_lv5_pemasangan = $request->limapuluh;
        $laporan_teknisi_instalasi->ph_lv6_pemasangan = $request->limapuluhsatu;
        $laporan_teknisi_instalasi->save();

        $laporan_teknisi_maintenance = LaporanTeknisi::where('id_slip_order','=',$request->id_slip_order)->first();
        $laporan_teknisi_maintenance->sumber_air_service1 = $request->tujuhpuluhdua;
        $laporan_teknisi_maintenance->tds_sebelum_service1 = $request->tujuhpuluhtiga;
        $laporan_teknisi_maintenance->tds_lv1_service1 = $request->tujuhpuluhempat;
        $laporan_teknisi_maintenance->tds_lv2_service1 = $request->tujuhpuluhlima;
        $laporan_teknisi_maintenance->tds_lv3_service1 = $request->tujuhpuluhenam;
        $laporan_teknisi_maintenance->tds_lv4_service1 = $request->tujuhpuluhtujuh;
        $laporan_teknisi_maintenance->tds_lv5_service1 = $request->tujuhpuluhdelapan;
        $laporan_teknisi_maintenance->tds_lv6_service1 = $request->tujuhpuluhsembilan;
        $laporan_teknisi_maintenance->ph_sebelum_service1 = $request->delapanpuluh;
        $laporan_teknisi_maintenance->ph_lv1_service1 = $request->delapanpuluhsatu;
        $laporan_teknisi_maintenance->ph_lv2_service1 = $request->delapanpuluhdua;
        $laporan_teknisi_maintenance->ph_lv3_service1 = $request->delapanpuluhtiga;
        $laporan_teknisi_maintenance->ph_lv4_service1 = $request->delapanpuluhempat;
        $laporan_teknisi_maintenance->ph_lv5_service1 = $request->delapanpuluhlima;
        $laporan_teknisi_maintenance->ph_lv6_service1 = $request->delapanpuluhenam;
        $laporan_teknisi_maintenance->save();

        // tabel pembayaran
        $tabel_pembayaran = Pembayaran::where('id_slip_order','=',$request->id_slip_order)->first();
        $tabel_pembayaran->dp = $request->limapuluhempat;
        $tabel_pembayaran->cicilan = $request->limapuluhlima;
        $tabel_pembayaran->save();
        
        // tabel maintenance
        $tabel_maintenance = Maintenance::where('id_slip_order','=',$request->id_slip_order)->first();
        $tabel_maintenance->jadwal1_service1 = $request->enampuluhtujuh;
        $tabel_maintenance->jadwal2_service1 = $request->enampuluhdelapan;
        $tabel_maintenance->teknisi_service1 = $request->enampuluhsembilan;
        $tabel_maintenance->tindakan_service1 = $request->tujuhpuluh;
        $tabel_maintenance->biaya_kunjungan_service1 = $request->tujuhpuluhsatu;
        $tabel_maintenance->save();      
        
        
                
        $message = 'changes saved';
        return back()->withInput()->withMessage($message);
    }

}
