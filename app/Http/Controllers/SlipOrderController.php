<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Customer;
use App\SlipOrder;
use App\SlipOrderDetail;
use App\DeliveryOrder;
use App\DeliveryOrderDetail;
use App\Pembayaran;
use App\Instalasi;
use App\Sementara;
use App\Maintenance;
use App\MasterBank;
use App\FaultRecurringHistory;
use App\MasterSewa;
use App\SalesManager;
use App\Sales;
use App\NomorOtomatis;
use DB;
use Cart;
use Carbon\Carbon;
use Response;
use PDF;
use Auth;
use App\Imports\Slip_ordersImport;
use App\Imports\Slip_order_detailImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerBanksExport;


class SlipOrderController extends Controller {
    private $searchParams = ['slip_order_no','customer','from','to','manajer','periode_sewa'];

    public function getIndex(Request $request){    
        $sewaRecurring = SlipOrder::where('tipe_penjualan','=','RECURRING')->count();        
        $sewaPeriode = SlipOrder::where('tipe_penjualan','=','SEWA')->count();        
        $putus = SlipOrder::where('tipe_penjualan','=','HAK MILIK')->count();
        $stock = [$sewaRecurring,$sewaPeriode, $putus];

        //sewa vs recurring vs beli graph
        for($i = 0; $i <= 5; $i++){
            $nowM = Carbon::now()->month;
            $nowY = Carbon::now()->year;
            $now = $nowY."-".$nowM."-15 00:00:00";
            $now = Carbon::parse($now);

            if($i == 0){
                $now = $now->format("Y-m-d");
            }else{
                $now = $now->subMonths($i)->format('Y-m-d');
            }        

            $from = Carbon::createFromFormat('Y-m-d', $now )->startOfMonth();
            $to = Carbon::createFromFormat('Y-m-d', $now )->endOfMonth();
            $month = Carbon::createFromFormat('Y-m-d',$now)->format("M");
            $months[] = $month;

            $sewaRecurring_array = SlipOrder::where('tipe_penjualan','=','RECURRING')->whereBetween('tanggal' , [$from , $to]);
            $penyewaanRecurring[] = $sewaRecurring_array->count();

            $sewaPeriode_array = SlipOrder::where('tipe_penjualan','=','SEWA')->whereBetween('tanggal' , [$from , $to]);
            $penyewaanPeriode[] = $sewaPeriode_array->count();
            
            $beli_array = SlipOrder::where('tipe_penjualan','=','HAK MILIK')->whereBetween('tanggal' , [$from , $to]);
            $pembelian[] = $beli_array->count();
        }
        
        return view('slipOrder.metro_so',compact('stock','months', 'penyewaanRecurring', 'penyewaanPeriode', 'pembelian','sewaRecurring','sewaPeriode','putus'));
    }

    public function indexSlipOrderNew () {
        return view('slipOrder.metro_so_new');
    }

    public function getNewSlipOrderSewaRecurring () {
        $nomor_otomatis = $this->autonumberSO();
        $tanggal_otomatis = $this->convertdate();
        $customers = Customer::get();
        $barangs = Barang::get();

        $userId = 1; // get this from session or wherever it came from
        
        if(request()->ajax()) {
            $items = [];

            \Cart::session($userId)->getContent()->each(function($item) use (&$items)
            {
                $items[] = $item;
            });

            return response(array(
                'success' => true,
                'data' => $items,
                'message' => 'cart get items success'
            ),200,[]);
        }
        else {
            return view('slipOrder.formSewaRecurring', compact('nomor_otomatis','tanggal_otomatis','customers','barangs'));
        }
    }

    public function getNewSlipOrderSewaPeriode (){
        $nomor_otomatis = $this->autonumberSO();
        $tanggal_otomatis = $this->convertdate();
        $customers = Customer::get();
        $barangs = Barang::get();

        $userId = 1; // get this from session or wherever it came from
        
        if(request()->ajax()){
            $items = [];

            \Cart::session($userId)->getContent()->each(function($item) use (&$items)
            {
                $items[] = $item;
            });

            return response(array(
                'success' => true,
                'data' => $items,
                'message' => 'cart get items success'
            ),200,[]);
        }
        else {
            return view('slipOrder.formSewaPeriode', compact('nomor_otomatis','tanggal_otomatis','customers','barangs'));
        }
    }

    public function getNewSlipOrderJualPutus (){
        $nomor_otomatis = $this->autonumberSO();
        $tanggal_otomatis = $this->convertdate();
        $customers = Customer::get();
        $barangs = Barang::get();
        $userId = 1; // get this from session or wherever it came from
        
        if(request()->ajax()){
            $items = [];

            \Cart::session($userId)->getContent()->each(function($item) use (&$items)
            {
                $items[] = $item;
            });

            return response(array(
                'success' => true,
                'data' => $items,
                'message' => 'cart get items success'
            ),200,[]);
        }
        else {
            return view('slipOrder.formJualPutus', compact('nomor_otomatis','tanggal_otomatis','customers','barangs'));
        }
    }
    
    // simpan slip order
    public function postSlipOrder(Request $request){   
        
        $this->validate($request, [
            'id_slip_order' => 'unique:slip_orders',
            'salesManager' => 'required|max:255',
            'sales' => 'required|max:255',
            'id_customer' => 'required|max:255',
        ]);

        $userId = Auth::user()->id;        
        // simpan cart ke database
        $items = Cart::session($userId)->getContent();        
        $total_quantity = Cart::session($userId)->getTotalQuantity();
        $sub_total = Cart::session($userId)->getSubTotal();
        $total_cart = Cart::session($userId)->getTotal();

        $tanggalan = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        $namanya = Customer::where('id','=',$request->nama_customer)->first();
            // kalau id so input manual----------------------------------------------------------------------------------------------------------------
        if ($request->id_slip_order != null) {
            if ($request->status_pelunasan === 'SewaRecurring') {
                $sisa_tagihan = 0;
            }
            if ($request->kelengkapan_data_recurring === 'isi') {
                $nama_pemilik_kartu_recurring = $request->nama_pemilik_kartu_recurring;
                $jenis_bank_recurring = $request->jenis_bank_recurring;
                $jenis_kartu_kredit_recurring = $request->jenis_kartu_kredit_recurring;
                $nomor_kartu_recurring = $request->nomor_kartu_recurring;
                $nominal_debit_recurring = $request->nominal_debit_recurring;
                $tanggal_debit_recurring = $request->tanggal_debit_recurring;
                $masa_kartu_expired_recurring = $request->masa_kartu_expired_recurring;
                $catatan_recurring = $request->catatan_recurring;
            } 
            else {
                $nama_pemilik_kartu_recurring = null;
                $jenis_bank_recurring = null;
                $jenis_kartu_kredit_recurring = null;
                $nomor_kartu_recurring = null;
                $nominal_debit_recurring = null;
                $tanggal_debit_recurring = null;
                $masa_kartu_expired_recurring = null;
                $catatan_recurring = 'Data recurring tidak lengkap, mohon untuk meminta data recurring sebelum melakukan pemasangan';
            }
    
            if ($request->tipe_penjualan === 'Recurring') {
                $metode_pembayaran_dp = $request->metode_pembayaran;
                $nominal_dp = $request->nominal_pembayaran;
                $bank_dp = $request->id_bank;            
                $status_recurring = $request->status_recurring;
                $status_upgrade = "belumUpgrade";
                $total_cartnya = $request->total_tagihan;
                $tempo_maintenance = Carbon::now()->addMonth(60)->format('Y-m-d'); 
                $layanan_service = null;   
            } 
            elseif ($request->tipe_penjualan === 'Sewa') {
                $metode_pembayaran_dp = null;
                $nominal_dp = null;
                $bank_dp = null;            
                $status_recurring = null;            
                $status_upgrade = "belumUpgrade";
                $total_cartnya = $request->total_tagihan;
                $tempo_maintenance = Carbon::now()->addMonth($request->periode_sewa)->format('Y-m-d');
                $layanan_service = null;
            }
            elseif ($request->tipe_penjualan === 'HAK MILIK') {
                $metode_pembayaran_dp = null;
                $nominal_dp = null;
                $bank_dp = null;            
                $status_recurring = null;
                $status_recurring = "Jual Putus";
                $status_upgrade = "Jual Putus";
                $tempo_maintenance = Carbon::now()->addMonth($request->layanan_service)->format('Y-m-d');
                $total_cartnya = $total_cart;
                $nominal_pembayaran2 = $request->nominal_pembayaran;
                $layanan_service = $request->layanan_service;
            }
    
            if ($request->status_pelunasan === 'SewaRecurring') {
                $sisa_tagihan = 0;
            } 
            else {
                $sisa_tagihan = $request->sisa_tagihan;
            } 
    
            if ($request->cicilan === "-- Cicilan --") {
                $cicilan = "lunas";
            } else {
                $cicilan = $request->cicilan;
            }
    
            if ($sisa_tagihan <= 0) {            
                $status_pelunasan = "LUNAS";
            } else {
                $status_pelunasan = "BELUM LUNAS";
            }                 
    
            $dataSlipOrder = SlipOrder::create([
                'id_slip_order' => $request->id_slip_order,
                'tanggal' => $tanggalan,
                'id_staf' => $request->id_staf,
                'id_customer' => $request->id_customer,
                'team' => $request->salesManager,
                'nama_seller' => $request->sales,
                'lokasi_penjualan' => $request->lokasi_penjualan,
                'kecamatan' => $request->kecamatan,
                'kab_kot' => $request->kab_kot,
                'provinsi' => $request->provinsi,
                'crc_code' => $request->crc_code,
                'nama_customer' => $namanya->nama_customer,
                'no_ktp' => $request->no_ktp,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_pemasangan' => $request->alamat_pemasangan,
                'milik_tempat_tinggal' => $request->milik_tempat_tinggal,
                'no_telp' => $request->no_telp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'tempo_maintenance' => $tempo_maintenance,
                'total_cart' => $total_cartnya,
                'jenis_bank2' => $request->jenis_bank,
                'nominal_pembayaran2' => $request->nominal_pembayaran,
                'tipe_penjualan' => $request->tipe_penjualan,
                'layanan_service' => $layanan_service,
                'periode_sewa' => $request->periode_sewa,
                'nama_pemilik_kartu_recurring' => $nama_pemilik_kartu_recurring,
                'jenis_bank_recurring' => $jenis_bank_recurring,
                'jenis_kartu_kredit_recurring' => $jenis_kartu_kredit_recurring,
                'nomor_kartu_recurring' => $nomor_kartu_recurring,
                'nominal_debit_recurring' => $nominal_debit_recurring,
                'tanggal_debit_recurring' => $tanggal_debit_recurring,
                'masa_kartu_expired_recurring' => $masa_kartu_expired_recurring,
                'catatan_recurring' => $catatan_recurring,
                'referensi_invoice' => $request->id_slip_order,     
                'remark' => $request->remark,            
                'metode_pembayaran_dp' => $metode_pembayaran_dp,
                'nominal_dp' => $nominal_dp,
                'bank_dp' => $bank_dp,            
                'status_recurring' => $status_recurring,
                'status_upgrade' => $status_upgrade,    
                'sisa_tagihan' => $sisa_tagihan,
                'status_pelunasan' => $status_pelunasan,            
            ]);

            SlipOrder::where('id_slip_order',$dataSlipOrder->id_slip_order)->update([
                'id_slip_order' => $request->id_slip_order
            ]);

            $no1 = NomorOtomatis::where('id',1)->first();
            // dd($no1);

            if ($no1) {                

                NomorOtomatis::where('id',$no1)->update([
                    'number' => ($no1->number - 1)
                ]);
                
            }           
            
                // ------------------------------------------------------------------------------------------------------------------------------------------
    
            if ($request->tipe_penjualan === 'HAK MILIK') {       
                for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
                    $id_bank = $request->jenis_bank[$ii];
                    $nominal_pembayaran = $request->nominal_pembayaran[$ii];
                    $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
                    if ($nominal_pembayaran != null) {
                        if ($id_bank === null) {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                                'metode_pembayaran' => 'tunai',
                                'id_slip_order' => $request->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => '-',
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }else {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                                'metode_pembayaran' => $metode_pembayaran,
                                'id_slip_order' => $request->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => $id_bank,
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }                    
                    }                 
                }
            }   
            elseif ($request->tipe_penjualan === 'Recurring') {
                $pembayaranPertama['tanggal_pembayaran'] = $tanggalan;
                $pembayaranPertama['keterangan_pembayaran'] = 'Pembayaran Recurring';
                $pembayaranPertama['metode_pembayaran'] = $request->metode_pembayaran;
                $pembayaranPertama['id_slip_order'] = $request->id_slip_order;
                $pembayaranPertama['id_customer'] = $request->id_customer;
                $pembayaranPertama['id_staf'] = $request->id_staf;
                $pembayaranPertama['id_bank'] = $request->id_bank;
                $pembayaranPertama['nominal_pembayaran'] = $request->total_tagihan;
                Pembayaran::create($pembayaranPertama);
            } 
            elseif ($request->tipe_penjualan === 'Sewa') {        
                for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
                    $id_bank = $request->jenis_bank[$ii];
                    $nominal_pembayaran = $request->nominal_pembayaran[$ii];
                    $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
                    if ($nominal_pembayaran != null) {
                        if ($id_bank === null) {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Periode',
                                'metode_pembayaran' => 'tunai',
                                'id_slip_order' => $request->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => '-',
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }else {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Periode',
                                'metode_pembayaran' => $metode_pembayaran,
                                'id_slip_order' => $request->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => $id_bank,
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }                    
                    }                 
                }
            }
     
                // ------------------------------------------------------------------------------------------------------------------------------------------
    
            $dataDeliveryOrder = DeliveryOrder::create([
                'id_slip_order' =>  $request->id_slip_order,
            ]);  
            
            $no2 = NomorOtomatis::where('id',2)->first();

            if ($no2 != null) {                

                NomorOtomatis::where('id',$no2)->update([
                    'number' => ($no2->number - 1)
                ]);
                
            }
           
            foreach($items as $item){      
                $detail['id_slip_order'] =  $request->id_slip_order;
                $detail['id_barang'] =  $item->id;   
                $detail['nama_barang'] =  $item->name;          
                $detail['harga'] =  $item->price;      
                $detail['qty'] =  $item->quantity;   
                SlipOrderDetail::create($detail);
    
                $instalasi['id_slip_order'] =  $request->id_slip_order;
                $instalasi['id_customer'] =  $request->id_customer;
                $instalasi['id_barang'] =  $item->id;
                Instalasi::create($instalasi);
    
                $DOdetail['id_do'] =  $dataDeliveryOrder->id_do;
                $DOdetail['id_barang'] =  $item->id;   
                $DOdetail['nama_barang'] =  $item->name;    
                $DOdetail['qty'] =  $item->quantity;   
                DeliveryOrderDetail::create($DOdetail); 
            }   
            
            $maintenance['id_slip_order'] =  $request->id_slip_order;
            $maintenance['id_customer'] =  $request->id_customer;
            Maintenance::create($maintenance);

            Cart::session($userId)->clear();
        } 
            //ini kalau id so otomatis -------------------------------------------------------------------------------------------- 
        else {
            if ($request->status_pelunasan === 'SewaRecurring') {
                $sisa_tagihan = 0;
            }
            if ($request->kelengkapan_data_recurring === 'isi') {
                $nama_pemilik_kartu_recurring = $request->nama_pemilik_kartu_recurring;
                $jenis_bank_recurring = $request->jenis_bank_recurring;
                $jenis_kartu_kredit_recurring = $request->jenis_kartu_kredit_recurring;
                $nomor_kartu_recurring = $request->nomor_kartu_recurring;
                $nominal_debit_recurring = $request->nominal_debit_recurring;
                $tanggal_debit_recurring = $request->tanggal_debit_recurring;
                $masa_kartu_expired_recurring = $request->masa_kartu_expired_recurring;
                $catatan_recurring = $request->catatan_recurring;
            } 
            else {
                $nama_pemilik_kartu_recurring = null;
                $jenis_bank_recurring = null;
                $jenis_kartu_kredit_recurring = null;
                $nomor_kartu_recurring = null;
                $nominal_debit_recurring = null;
                $tanggal_debit_recurring = null;
                $masa_kartu_expired_recurring = null;
                $catatan_recurring = 'Data recurring tidak lengkap, mohon untuk meminta data recurring sebelum melakukan pemasangan';
            }
    
            if ($request->tipe_penjualan === 'Recurring') {
                $metode_pembayaran_dp = $request->metode_pembayaran;
                $nominal_dp = $request->nominal_pembayaran;
                $bank_dp = $request->id_bank;            
                $status_recurring = $request->status_recurring;
                $status_upgrade = "belumUpgrade";
                $total_cart = $total_cart;
                $tempo_maintenance = Carbon::now()->addMonth(60)->format('Y-m-d');  
                $total_cartnya = $request->total_tagihan;                 
                $layanan_service = null;    
            } 
            elseif ($request->tipe_penjualan === 'Sewa') {
                $metode_pembayaran_dp = null;
                $nominal_dp = null;
                $bank_dp = null;            
                $status_recurring = null;            
                $status_upgrade = "belumUpgrade";
                $total_cart = $request->biaya_sewa_periode;
                $tempo_maintenance = Carbon::now()->addMonth($request->periode_sewa)->format('Y-m-d');
                $total_cartnya = $request->total_tagihan;
                $layanan_service = null;
            }
            elseif ($request->tipe_penjualan === 'HAK MILIK') {
                $metode_pembayaran_dp = null;
                $nominal_dp = null;
                $bank_dp = null;            
                $status_recurring = null;
                $status_recurring = "Jual Putus";
                $status_upgrade = "Jual Putus";
                $tempo_maintenance = Carbon::now()->addMonth($request->layanan_service)->format('Y-m-d');
                $total_cartnya = $total_cart;                
                $layanan_service = $request->layanan_service;
            }
    
            if ($request->status_pelunasan === 'SewaRecurring') {
                $sisa_tagihan = 0;
            } 
            else {
                $sisa_tagihan = $request->sisa_tagihan;
            } 
    
            if ($request->cicilan === "-- Cicilan --") {
                $cicilan = "lunas";
            } else {
                $cicilan = $request->cicilan;
            }
    
            if ($sisa_tagihan <= 0) {            
                $status_pelunasan = "LUNAS";
            } else {
                $status_pelunasan = "BELUM LUNAS";
            }                 
    
            $dataSlipOrder = SlipOrder::create([
                'tanggal' => $tanggalan,
                'id_staf' => $request->id_staf,
                'id_customer' => $request->id_customer,
                'team' => $request->salesManager,
                'nama_seller' => $request->sales,
                'lokasi_penjualan' => $request->lokasi_penjualan,
                'kecamatan' => $request->kecamatan,
                'kab_kot' => $request->kab_kot,
                'provinsi' => $request->provinsi,
                'crc_code' => $request->crc_code,
                'nama_customer' => $namanya->nama_customer,
                'no_ktp' => $request->no_ktp,
                'alamat_ktp' => $request->alamat_ktp,
                'alamat_pemasangan' => $request->alamat_pemasangan,
                'milik_tempat_tinggal' => $request->milik_tempat_tinggal,
                'no_telp' => $request->no_telp,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'tempo_maintenance' => $tempo_maintenance,
                'total_cart' => $total_cartnya,
                'jenis_bank2' => $request->jenis_bank,
                'nominal_pembayaran2' => $request->nominal_pembayaran,
                'tipe_penjualan' => $request->tipe_penjualan,
                'layanan_service' => $layanan_service,
                'periode_sewa' => $request->periode_sewa,
                'nama_pemilik_kartu_recurring' => $nama_pemilik_kartu_recurring,
                'jenis_bank_recurring' => $jenis_bank_recurring,
                'jenis_kartu_kredit_recurring' => $jenis_kartu_kredit_recurring,
                'nomor_kartu_recurring' => $nomor_kartu_recurring,
                'nominal_debit_recurring' => $nominal_debit_recurring,
                'tanggal_debit_recurring' => $tanggal_debit_recurring,
                'masa_kartu_expired_recurring' => $masa_kartu_expired_recurring,
                'catatan_recurring' => $catatan_recurring,     
                'remark' => $request->remark,            
                'metode_pembayaran_dp' => $metode_pembayaran_dp,
                'nominal_dp' => $nominal_dp,
                'bank_dp' => $bank_dp,            
                'status_recurring' => $status_recurring,
                'status_upgrade' => $status_upgrade,    
                'sisa_tagihan' => $sisa_tagihan,
                'status_pelunasan' => $status_pelunasan,            
            ]);

            SlipOrder::where('id_slip_order',$dataSlipOrder->id_slip_order)->update([                
                'referensi_invoice' => $dataSlipOrder->id_slip_order,
            ]);
                // ------------------------------------------------------------------------------------------------------------------------------------------
    
            if ($request->tipe_penjualan === 'HAK MILIK') {       
                for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
                    $id_bank = $request->jenis_bank[$ii];
                    $nominal_pembayaran = $request->nominal_pembayaran[$ii];
                    $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
                    if ($nominal_pembayaran != null) {
                        if ($id_bank === null) {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                                'metode_pembayaran' => 'tunai',
                                'id_slip_order' => $dataSlipOrder->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => '-',
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }else {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                                'metode_pembayaran' => $metode_pembayaran,
                                'id_slip_order' => $dataSlipOrder->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => $id_bank,
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }                    
                    }                 
                }
            }   
            elseif ($request->tipe_penjualan === 'Recurring') {
                $pembayaranPertama['tanggal_pembayaran'] = $tanggalan;
                $pembayaranPertama['keterangan_pembayaran'] = 'Pembayaran Recurring';
                $pembayaranPertama['metode_pembayaran'] = $request->metode_pembayaran;
                $pembayaranPertama['id_slip_order'] = $dataSlipOrder->id_slip_order;
                $pembayaranPertama['id_customer'] = $request->id_customer;
                $pembayaranPertama['id_staf'] = $request->id_staf;
                $pembayaranPertama['id_bank'] = $request->id_bank;
                $pembayaranPertama['nominal_pembayaran'] = $request->total_tagihan;
                Pembayaran::create($pembayaranPertama);
            } 
            elseif ($request->tipe_penjualan === 'Sewa') {        
                for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
                    $id_bank = $request->jenis_bank[$ii];
                    $nominal_pembayaran = $request->nominal_pembayaran[$ii];
                    $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
                    if ($nominal_pembayaran != null) {
                        if ($id_bank === null) {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Periode',
                                'metode_pembayaran' => 'tunai',
                                'id_slip_order' => $dataSlipOrder->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => '-',
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }else {
                            Pembayaran::create([
                                'tanggal_pembayaran' => $tanggalan,
                                'keterangan_pembayaran' => 'Pembayaran Periode',
                                'metode_pembayaran' => $metode_pembayaran,
                                'id_slip_order' => $dataSlipOrder->id_slip_order,
                                'id_customer' => $request->id_customer,
                                'id_staf' => $request->id_staf,
                                'id_bank' => $id_bank,
                                'nominal_pembayaran'=>$nominal_pembayaran
                            ]);
                        }                    
                    }                 
                }
            }
     
                // ------------------------------------------------------------------------------------------------------------------------------------------
    
            $dataDeliveryOrder = DeliveryOrder::create([
                'id_slip_order' =>  $dataSlipOrder->id_slip_order,
            ]);               
           
            foreach($items as $item){      
                $detail['id_slip_order'] =  $dataSlipOrder->id_slip_order;
                $detail['id_barang'] =  $item->id;   
                $detail['nama_barang'] =  $item->name;          
                $detail['harga'] =  $item->price;      
                $detail['qty'] =  $item->quantity;   
                SlipOrderDetail::create($detail);
    
                $instalasi['id_slip_order'] =  $dataSlipOrder->id_slip_order;
                $instalasi['id_customer'] =  $request->id_customer;
                $instalasi['id_barang'] =  $item->id;
                Instalasi::create($instalasi);
    
                $DOdetail['id_do'] =  $dataDeliveryOrder->id_do;
                $DOdetail['id_barang'] =  $item->id;   
                $DOdetail['nama_barang'] =  $item->name;    
                $DOdetail['qty'] =  $item->quantity;   
                DeliveryOrderDetail::create($DOdetail); 
            }   
            
            $maintenance['id_slip_order'] =  $dataSlipOrder->id_slip_order;
            $maintenance['id_customer'] =  $request->id_customer;
            Maintenance::create($maintenance);

            Cart::session($userId)->clear();
        }      
        
        $message = 'data saved';
        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }

    public function getIndexFaultDataRecurring(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $inputRecurring = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('status_recurring','=','belumRecurring')->get();
        $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('status_recurring','=','gagalRecurring')->orderBy('id_slip_order', 'asc');        
               
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
        return view('slipOrder.indexFaultDataRecurring')->withSewa($sewa->paginate(10))->withCustomers($customers)->withInputRecurring($inputRecurring);
    }

    public function getInputFaultDataRecurring(){     
        $inputRecurring = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('status_recurring','=','belumRecurring')->get();
        
        return view('slipOrder.inputFaultDataRecurring')->withInputRecurring($inputRecurring);
    }

    public function postIndexFaultDataRecurring(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexFaultDataRecurring', $params);
    }

    public function simpanUbahStatusRecurring(Request $request){
        if(!is_null($request->id_rubah)){
            foreach($request->id_rubah as $key => $value){
                $quarters = SlipOrder::find($request->id_rubah[$key]); 
                $quarters->status_recurring = $request->status_recurring[$key]; 
                $quarters->remark_recurring = $request->remark_recurring[$key]; 
                $quarters->save();
                
                if ($request->status_recurring[$key] === "gagalRecurring") {
                    $faultHistory['id_slip_order'] =  $quarters->id_slip_order;   
                    $faultHistory['id_customer'] =  $quarters->id_customer;   
                    $faultHistory['remark_recurring'] =  $request->remark_recurring[$key];   
                    FaultRecurringHistory::create($faultHistory); 
                }                 
            }           
            $message = 'changes saved';
            return back()->withInput()->withMessage($message);
        }else{
            $message = 'nothing saved';
            return back()->withInput()->withMessage($message);
        }                    
    }

    public function updateStatusFaultDataRecurring(Request $request){
        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $so->status_recurring = "berhasilRecurring";
        $so->save(); 
        $message = 'changes saved';
        return back()->withInput()->withMessage($message);                  
    }

    public function getIndexSewaRecurring(Request $request){ 
        $hariIni = Carbon::now()->format('Y-m-d');
        // upgrade ke milik

        $jabatan = Auth::user()->status; 
        if ($jabatan === 'HEAD ACCOUNTING' || $jabatan === 'HEAD ADMIN FINANCE' || $jabatan === 'STAFF ACCOUNTING') {
            // menampilkan data 
            $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
            $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('tanggal_hak_milik','!=','Recurring')->orderBy('id_slip_order', 'asc');  
        } else {
            // menampilkan data 
            $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
            $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')->orderBy('id_slip_order', 'asc');  
        }                
        
        if($request->get('slip_order_no')) {
            $sewa->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $sewa->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('manajer')) {
            $sewa->where('team', 'LIKE', '%' . $request->get('manajer') . '%');
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
        
        $cloneTransactionForNetTotal = clone $sewa;
        $net_total = $cloneTransactionForNetTotal->sum('total_cart');

        return view('slipOrder.indexSewaRecurring',compact('hariIni'))
        ->withSewa($sewa->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndexSewaRecurring(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewaRecurring', $params);
    }

    public function getIndexSewaRecurring10(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('tanggal_debit_recurring','=','10')->orderBy('id_slip_order', 'asc');        
        
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
        return view('slipOrder.indexSewaRecurring10')->withSewa($sewa->paginate(10))->withCustomers($customers);
    }

    public function postIndexSewaRecurring10(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewaRecurring10', $params);
    }

    public function getIndexSewaRecurring25(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('tanggal_debit_recurring','=','25')->orderBy('id_slip_order', 'asc');        
        
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

        return view('slipOrder.indexSewaRecurring25')->withSewa($sewa->paginate(10))->withCustomers($customers);
    }

    public function postIndexSewaRecurring25(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewaRecurring25', $params);
    }

    public function postIndexSewaRecurringPerminggu(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewa', $params);
    }
    // -----------------------------------------------------------------------------------------------------------
    public function getIndexSewaPeriode(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $sewa = SlipOrder::where('tipe_penjualan','=','SEWA')->orderBy('id_slip_order', 'asc');        
        
        if($request->get('slip_order_no')) {
            $sewa->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $sewa->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('manajer')) {
            $sewa->where('team', 'LIKE', '%' . $request->get('manajer') . '%');
        }

        if($request->get('periode_sewa')) {
            $sewa->where('periode_sewa', 'LIKE', '%' . $request->get('periode_sewa') . '%');
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
        
        $cloneTransactionForNetTotal = clone $sewa;
        $net_total = $cloneTransactionForNetTotal->sum('total_cart');

        return view('slipOrder.indexSewaPeriode')
        ->withSewa($sewa->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndexSewaPeriode(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewaPeriode', $params);
    }

    public function postIndexSewaPerminggu(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexSewa', $params);
    }

    public function getIndexPutus(Request $request){     
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $putus = SlipOrder::where('tipe_penjualan','=','HAK MILIK')->orderBy('id_slip_order', 'asc');        
          
        if($request->get('slip_order_no')) {
            $putus->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $putus->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $putus->whereBetween('tanggal',[$from,$to]);
            }else{
                $putus->where('tanggal','<=',$to);
            }
        } 
        
        $cloneTransactionForNetTotal = clone $putus;
        $net_total = $cloneTransactionForNetTotal->sum('total_cart');

        return view('slipOrder.indexPutus')
        ->withPutus($putus->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndexPutus(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexPutus', $params);
    }

    public function postIndexPutusPerminggu(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getIndexPutus', $params);
    }

    public function getInvoiceDetails($id){
        $so = SlipOrder::with('bank')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::where('id_slip_order','=',$id)->get();
        $banks = MasterBank::get();
        return view('slipOrder.detailSewa',compact('pembayaran','so','banks'));
    }

    public function detailKeuangan($id){
        $so = SlipOrder::where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::where('id_slip_order','=',$id)->get();
        return view('akunting.detailKeuangan',compact('pembayaran','so'));
    }

    public function getInvoiceDetailsPeriode($id){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::with('bank')->where('id_slip_order','=',$id)->get();
        $banks = MasterBank::all();
        return view('slipOrder.detailPeriode',compact('pembayaran','so','banks'));
    }
    
    public function getInvoiceDetailsPutus(Request $request){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->where('id_slip_order','=',$request->id_slip_order)->first();
        $pembayaran = Pembayaran::with('bank')->where('id_slip_order','=',$request->id_slip_order)->get();
        $banks = MasterBank::all();
        return view('slipOrder.detailPutus',compact('pembayaran','so','banks'));
    }

    public function bayarSewa(Request $request){ 
        $this->validate($request, [
            'tanggal_pembayaran' => 'required|max:255',
        ]);

        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        
        $data['tanggal_pembayaran'] = $request->tanggal_pembayaran;
        $data['id_slip_order'] = $so->id_slip_order;
        $data['id_customer'] = $so->id_customer;
        $data['id_staf'] = $request->id_staf;
        $data['nama_pemilik_kartu'] = $so->nama_pemilik_kartu_recurring;
        $data['id_bank'] = $so->jenis_bank_recurring;
        $data['metode_pembayaran'] = $so->jenis_kartu_kredit_recurring;
        $data['nomor_kartu'] = $so->nomor_kartu_recurring;
        $data['tanggal_debit'] = $so->tanggal_debit_recurring;
        $data['masa_kartu_expired'] = $so->masa_kartu_expired_recurring;
        $data['nominal_pembayaran'] = $request->nominal_pembayaran;

        if ($so->tipe_penjualan === 'Recurring') {            
            $data['keterangan_pembayaran'] = 'Pembayaran Recurring';
        }elseif($so->tipe_penjualan === 'Sewa'){
            $data['keterangan_pembayaran'] = 'Pembayaran Periode';
        } 

        Pembayaran::create($data);       

        $message = 'changes saved';
        if ($so->tipe_penjualan === 'Recurring') {
            return redirect('SO/'.$request->id_slip_order.'/details')->withMessage($message);
        }elseif($so->tipe_penjualan === 'Sewa'){
            return redirect('SO/'.$request->id_slip_order.'/detailsPeriode')->withMessage($message);
        }        
    }

    public function bayarPinalti(Request $request){ 
        $this->validate($request, [
            'tanggal_pembayaran' => 'required|max:255',
        ]);

        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        
        $data['tanggal_pembayaran'] = $request->tanggal_pembayaran;
        $data['id_slip_order'] = $so->id_slip_order;
        $data['id_customer'] = $so->id_customer;
        $data['id_staf'] = $request->id_staf;
        $data['nama_pemilik_kartu'] = $so->nama_pemilik_kartu_recurring;
        $data['id_bank'] = $so->jenis_bank_recurring;
        $data['metode_pembayaran'] = $so->jenis_kartu_kredit_recurring;
        $data['nomor_kartu'] = $so->nomor_kartu_recurring;
        $data['tanggal_debit'] = $so->tanggal_debit_recurring;
        $data['masa_kartu_expired'] = $so->masa_kartu_expired_recurring;
        $data['nominal_pembayaran'] = $request->nominal_pembayaran;                  
        $data['keterangan_pembayaran'] = 'Pembayaran Pinalti';       

        Pembayaran::create($data);       

        $message = 'changes saved';
        if ($so->tipe_penjualan === 'Recurring') {
            return redirect('SO/'.$request->id_slip_order.'/details')->withMessage($message);
        }elseif($so->tipe_penjualan === 'Sewa'){
            return redirect('SO/'.$request->id_slip_order.'/detailsPeriode')->withMessage($message);
        }        
    }

    public function bayarCicilan(Request $request){ 
        // dd($request->jenis_bank,$request->nominal_pembayaran,$request->metode_pembayaran_putus);
        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $tanggalan = Carbon::now()->format('Y-m-d');
        
        for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
            $id_bank = $request->jenis_bank[$ii];
            $nominal_pembayaran = $request->nominal_pembayaran[$ii];
            $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
            if ($nominal_pembayaran != null) {
                if ($id_bank === null) {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => 'tunai',
                        'id_slip_order' => $so->id_slip_order,
                        'id_customer' => $so->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => '-',
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }else {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => $metode_pembayaran,
                        'id_slip_order' => $so->id_slip_order,
                        'id_customer' => $so->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => $id_bank,
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }
                $so->sisa_tagihan = $so->sisa_tagihan - $nominal_pembayaran;
                $so->save();
            } 
        }
        $message = 'changes saved';
        return redirect('SO/'.$request->id_slip_order.'/detailsPutus')->withMessage($message);
    }

    public function bayarCicilanPeriode(Request $request){ 
        $so = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $tanggalan = Carbon::now()->format('Y-m-d');
        
        for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
            $id_bank = $request->jenis_bank[$ii];
            $nominal_pembayaran = $request->nominal_pembayaran[$ii];
            $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
            if ($nominal_pembayaran != null) {
                if ($id_bank === null) {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => 'tunai',
                        'id_slip_order' => $so->id_slip_order,
                        'id_customer' => $so->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => '-',
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }else {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => $metode_pembayaran,
                        'id_slip_order' => $so->id_slip_order,
                        'id_customer' => $so->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => $id_bank,
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }
                $so->sisa_tagihan = $so->sisa_tagihan - $nominal_pembayaran;
                $so->save();
            } 
        } 
        $message = 'changes saved';
        return redirect('SO/'.$request->id_slip_order.'/detailsPeriode')->withMessage($message);
    }

    public function getDownload(Request $request) {
        // prepare content
        $logs = SlipOrder::all();
        // dd($logs);
        $content = "\n";
        $i = 00001;
        foreach ($logs as $log) {
          $content .= $i.$log->nomor_kartu_recurring.$log->jenis_bank_recurring."00".$log->nominal_debit_recurring.$log->tanggal_debit_recurring.$log->masa_kartu_expired_recurring.$log->id_slip_order;
          $content .= "\n";
          $i++;
        }
    
        // file name that will be used in the download
        $fileName = "logs.txt";
    
        // use headers in order to generate the download
        $headers = [
          'Content-type' => 'text/plain', 
          'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        //   'Content-Length' => sizeof($content)
        ];
    
        // make a response, with the content, a 200 response code and the headers
        return Response::make($content, 200, $headers);        
    }

    public function bankFormatSewa(Request $request,$tanggal){ 
        $this->validate($request, [
            'nomor_merchant' => 'required',
            'mcc' => 'required',
            'tanggal_transaksi' => 'required',
            'sequence_control' => 'required'
        ]);
        
        $tanggal_transaksi = Carbon::createFromFormat('Y-m-d', $request->tanggal_transaksi)->format('mdy');
        $sewa = SlipOrder::where('tipe_penjualan','=','RECURRING')
        ->where('tarikan_barang','=','FALSE')
        ->where('tanggal_debit_recurring','=',$tanggal)
        // ->where('tanggal_hak_milik','!=',null)
        ->orderBy('id_slip_order', 'asc')->get();        
        // dd($sewa);
        if ($sewa->isEmpty()) {
            $message = 'Data Kosong';
            return back()->withMessage($message); 
        }

        $cek = SlipOrder::where('tipe_penjualan','=','RECURRING')->where('tarikan_barang','=','FALSE')->where('catatan_recurring','=','Data recurring tidak lengkap, mohon untuk meminta data recurring sebelum melakukan pemasangan')->first();        
        $month=Carbon::now()->format('m');       
        $year=Carbon::now()->format('y');       
        $month2=Carbon::now()->format('m-y');       
        
        if (!empty ( $cek )) {
            $message = 'Data Recurring Belum Lengkap, Mohon dilengkapi data recurring sebelum melakukan konvert';
            return redirect()->route('daftarRecurringKosong')->withMessage($message);  
        }else{
            foreach($sewa as $item){  

                $quarters = SlipOrder::find($item->id_slip_order); 
                $quarters->status_recurring = 'belumRecurring'; 
                $quarters->save();

                $SO['nomor_otomatis'] = $this->autonumberKonvert();
                $SO['nomor_kartu_recurring'] = $item->nomor_kartu_recurring;
                $SO['jenis_bank_recurring'] = $item->jenis_bank_recurring;
                $SO['nominal_debit_recurring'] = $item->nominal_debit_recurring;
                $SO['tanggal_debit_recurring'] = $month.$item->tanggal_debit_recurring.$year;
                $SO['masa_kartu_expired_recurring'] = $item->masa_kartu_expired_recurring;
                $SO['id_slip_order'] = $item->id_slip_order;
                Sementara::create($SO); 
            }

            $sementara = Sementara::all();
            $idTerakhir = Sementara::latest('nomor_otomatis')->first();
            // dd($idTerakhir);
            if ($idTerakhir != null) {
                $content = $idTerakhir->nomor_otomatis.$request->nomor_merchant.$request->mcc.$tanggal_transaksi.$request->sequence_control.$idTerakhir->nomor_otomatis."xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
            } else{
                $content = "\n";
            }
            $content .= "\n";
            foreach ($sementara as $data) {
                $content .= $data->nomor_otomatis.$data->nomor_kartu_recurring.$data->jenis_bank_recurring."00".$data->nominal_debit_recurring.$data->tanggal_debit_recurring.$data->masa_kartu_expired_recurring.$data->id_slip_order.'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
                $content .= "\n";
            }
        
            // file name that will be used in the download
            $fileName = "dataRecurring (".$tanggal."-".$month2.").txt";
    
            // use headers in order to generate the download
            $headers = [
            'Content-type' => 'text/plain', 
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            //   'Content-Length' => sizeof($content)
            ];
            Sementara::truncate();

            $resetNomor = NomorOtomatis::find(3); 
            $resetNomor->number = 0; 
            $resetNomor->save();
            
            // make a response, with the content, a 200 response code and the headers
            return Response::make($content, 200, $headers);    
        }
    }    

    public function daftarRecurringKosong(){
        $cek = SlipOrder::with('bank')->where('tipe_penjualan','=','RECURRING')->where('tarikan_barang','=','FALSE')->where('catatan_recurring','=','Data recurring tidak lengkap, mohon untuk meminta data recurring sebelum melakukan pemasangan')->get();        
        $message = 'Data Recurring Belum Lengkap, Mohon dilengkapi data recurring sebelum melakukan konvert';
        return view('slipOrder.indexSewaRecurringBelumLengkap')->withCek($cek)->withMessage($message); 
    }

    public function updateRecurring($id){
        $so = SlipOrder::with('bank')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::where('id_slip_order','=',$id)->get();
        $banks = MasterBank::get();
        return view('slipOrder.recurringUpdate',compact('pembayaran','so','banks'));
    }

    public function getAkunting(Request $request){
        $customers =  Customer::orderBy('nama_customer', 'asc')->pluck('nama_customer', 'id');
        $slipOrder = SlipOrder::with('pembayar');
        $bank = MasterBank::with('uangnya')->get();
        $dataPembayaran = Pembayaran::get();
        
        if($request->get('slip_order_no')) {
            $slipOrder->where('id_slip_order', 'LIKE', '%' . $request->get('slip_order_no') . '%');
        }

        if($request->get('customer')) {
            $slipOrder->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        if($request->get('manajer')) {
            $slipOrder->where('team', 'LIKE', '%' . $request->get('manajer') . '%');
        }

        if($request->get('from') || $request->get('to')) {
            if(!is_null($request->get('from'))){
                $from = Carbon::parse($request->get('from'))->format('Y-m-d') . ' 00:00:01';
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $slipOrder->whereBetween('created_at',[$from,$to]);
            }else{
                $to = Carbon::parse($request->get('to'))->format('Y-m-d') . ' 23:59:59';
                $slipOrder->where('tanggal','<=',$to);
            }
        }
        
        return view('akunting.indexAkunting',compact('bank','dataPembayaran'))->withSlipOrder($slipOrder->paginate(10))->withCustomers($customers);
    }

    public function postAkunting(Request $request){
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SlipOrderController@getAkunting', $params);
    }

    public function akuntingBank($id){
        $nama_bank = MasterBank::where('kode_bank','=',$id)->first();
        $bank = Pembayaran::where('id_bank','=',$id)->get();
        return view('akunting.indexAkuntingBank',compact('nama_bank','bank'));
    }

    public function exportExcelPerBank($kodeBank){
        $bank = MasterBank::where('kode_bank','=',$kodeBank)->first();
        $namaBank = $bank->nama_bank;
        $headings = [
            'Kode Bank', 
            'Nama Bank', 
            'ID Slip Order', 
            'Keterangan Pembayaran', 
            'Nominal'
        ];
        $tanggalan = Carbon::now()->format('d-m-Y');

        return Excel::download(new PerBanksExport($kodeBank,$namaBank,$headings), $namaBank.' - '.$tanggalan.'.xlsx');
    }

    public function getIndexAkunting(Request $request){    
        //sewa vs beli graph
        for($i = 0; $i <= 5; $i++){
            $nowM = Carbon::now()->month;
            $nowY = Carbon::now()->year;
            $now = $nowY."-".$nowM."-15 00:00:00";
            $now = Carbon::parse($now);

            if($i == 0){
                $now = $now->format("Y-m-d");
            }else{
                $now = $now->subMonths($i)->format('Y-m-d');
            }        

            $from = Carbon::createFromFormat('Y-m-d', $now )->startOfMonth();
            $to = Carbon::createFromFormat('Y-m-d', $now )->endOfMonth();
            $month = Carbon::createFromFormat('Y-m-d',$now)->format("M");
            $months[] = $month;

            $sewa_array = SlipOrder::where('tipe_penjualan','=','SEWA')->whereBetween('created_at' , [$from , $to]);
            $penyewaan[] = $sewa_array->count();
            
            $beli_array = SlipOrder::where('tipe_penjualan','=','HAK MILIK')->whereBetween('created_at' , [$from , $to]);
            $pembelian[] = $beli_array->count();
        }

        $total_invoice = SlipOrder::count();
        $total_transaksi = SlipOrder::get();
        
        $resultT = collect($total_transaksi)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksi = array_sum(array_column($resultT, 'total_cart'));            
            
        $sewa = SlipOrder::where('tipe_penjualan','=','SEWA')->count();
        $putus = SlipOrder::where('tipe_penjualan','=','HAK MILIK')->count();
        
        $stock = [$sewa, $putus];

        $total_transaksi_sewa = SlipOrder::where('tipe_penjualan','=','SEWA')->get();
        $resultTransaksi_sewa = collect($total_transaksi_sewa)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksiSewa = array_sum(array_column($resultTransaksi_sewa, 'total_cart'));
        
        $total_transaksi_putus= SlipOrder::where('tipe_penjualan','=','HAK MILIK')->get();
        $resultTransaksi_putus = collect($total_transaksi_putus)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksiPutus = array_sum(array_column($resultTransaksi_putus, 'total_cart'));

        if ($request->get('id_invoice')) {
            $customers->where(function($q) use($request) {
                $q->where('id_invoice', 'LIKE', '%' . $request->get('id_invoice') . '%');
            });
        }
        return view('akunting.indexAkunting',compact('total_invoice','totalTransaksi','totalTransaksiSewa','totalTransaksiPutus','sewa','HAK MILIK','stock','months','penyewaan','pembelian'));
    } 

    public static function convertdate(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d/m/Y');
        return $date;
    }

    public static function autonumberSO(){
        $q=DB::table('slip_orders')->select(DB::raw('MAX(RIGHT(id_slip_order,5)) as kd_max'));
        $prx='SO-';
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else{
            $kd = "00001";
        }
        return $kd;
    }
    
    public static function autonumberDO(){
        $q=DB::table('delivery_orders')->select(DB::raw('MAX(RIGHT(id_do,5)) as kd_max'));
        $prx='DO-';
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else{
            $kd = "00001";
        }
        return $kd;
    }

    public static function autonumberKonvert(){
        $q=DB::table('sementaras')->select(DB::raw('MAX(RIGHT(id_slip_order,5)) as kd_max'));
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else{
            $kd = "00001";
        }
        return $kd;
    }

    public function simpanNewBank(Request $request){
        $newBank['kode_bank'] =  $request->new_kode_bank;    
        $newBank['nama_bank'] =  $request->new_nama_bank;    
        MasterBank::create($newBank);
        return response(Response::HTTP_CREATED);
    }

    public function getBank(){
        $banks = MasterBank::all();
        // dd($banks);
        return response()->json($banks, 200);
    }

    public function cetakSewa($id){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->with('slipOrderDetail')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::where('id_slip_order','=',$id)->first();
        // dd($pembayaran);
        return view('printLayout.printerContentSewa',compact('so','pembayaran'));
    }

    public function cetakPeriode($id){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->with('slipOrderDetail')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::with('bank')->where('id_slip_order','=',$id)->get();
        // dd($pembayaran);
        return view('printLayout.printerContentPeriode',compact('so','pembayaran'));
    }

    public function cetakPutus($id){
        $so = SlipOrder::with('salesnya')->with('salesManagernya')->with('slipOrderDetail')->where('id_slip_order','=',$id)->first();
        $pembayaran = Pembayaran::with('bank')->where('id_slip_order','=',$id)->get();
        return view('printLayout.printerContentPutus',compact('so','pembayaran'));
    }

    public function settingBiayaSewa(Request $request){ 
        $data['biaya_sewa'] = $request->biaya_sewa;
        MasterSewa::create($data); 
    }

    public function isiDataRecurring(Request $request){

        $this->validate($request, [
            'nomor_kartu_recurring' => 'required|max:255'
        ]);

        $data = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $data->nama_pemilik_kartu_recurring = $request->nama_pemilik_kartu_recurring;
        $data->jenis_bank_recurring = $request->jenis_bank_recurring;
        $data->jenis_kartu_kredit_recurring = $request->jenis_kartu_kredit_recurring;
        $data->nomor_kartu_recurring = $request->nomor_kartu_recurring;
        $data->nominal_debit_recurring = $request->nominal_debit_recurring;
        $data->tanggal_debit_recurring = $request->tanggal_debit_recurring;
        $data->masa_kartu_expired_recurring = $request->masa_kartu_expired_recurring;
        $data->remark = $request->remark;
        $data->catatan_recurring = null;
        $data->save(); 
        $message = 'changes saved';
        return back()->withInput()->withMessage($message);                  
    }
    
    public function editBiayaSewa(Request $request){
        $bs = MasterSewa::where('id','=',1)->first();
        $bs->biaya_sewa = $request->nominal_biaya_sewa;
        $bs->save(); 
        $message = 'changes saved';
        return back()->withInput()->withMessage($message);                  
    }

    public function biayaSewa(){
        $biaya_sewa = MasterSewa::first();
        return view('setting_sewa.indexSettingSewa',compact('biaya_sewa'));
    }

    public function so_recurring_pdf_export($id){
        $transaction = SlipOrder::where('id_slip_order','=',$id)->first();
        dd($transaction);
        $pdf = PDF::loadview('slipOrder.SO_pdf',['transactions'=>$transaction]);
        // return $pdf->download('laporan-destinasi-pdf');
        return $pdf->download('Slip Order-'.$request->id_slip_order.'-pdf');
    }

    public function upgradeStatusSewa(Request $request){
        $jumlah_pembayaran = 0;
        foreach ($request->nominal_pembayaran as $item) {
            $jumlah_pembayaran += $item;
        }        
        // dd($request->jenis_bank,$request->nominal_pembayaran,$request->metode_pembayaran_putus);
        $soAwal = SlipOrder::where('id_slip_order','=',$request->id_slip_order)->first();
        $tanggalan = Carbon::now()->format('Y-m-d');
        
        $SO['id_slip_order'] = $soAwal->id_slip_order.'A';
        $SO['tanggal'] = $tanggalan;
        $SO['id_staf'] = Auth::user()->id;
        $SO['id_customer'] = $soAwal->id_customer;
        $SO['team'] = $soAwal->team;
        $SO['nama_seller'] = $soAwal->nama_seller;
        $SO['lokasi_penjualan'] = $soAwal->lokasi_penjualan;
        $SO['kecamatan'] = $soAwal->kecamatan;
        $SO['kab_kot'] = $soAwal->kab_kot;
        $SO['provinsi'] = $soAwal->provinsi;
        $SO['crc_code'] = $soAwal->crc_code;
        $SO['la_code'] = $soAwal->la_code;
        $SO['nama_customer'] = $soAwal->nama_customer;
        $SO['no_ktp'] = $soAwal->no_ktp;
        $SO['alamat_ktp'] = $soAwal->alamat_ktp;
        $SO['alamat_pemasangan'] = $soAwal->alamat_pemasangan;
        $SO['milik_tempat_tinggal'] = $soAwal->milik_tempat_tinggal;
        $SO['no_telp'] = $soAwal->no_telp;
        $SO['no_hp'] = $soAwal->no_hp;
        $SO['email'] = $soAwal->email;
        $SO['metode_pembayaran_dp'] = $soAwal->metode_pembayaran;
        $SO['nominal_dp'] = $soAwal->nominal_pembayaran;
        $SO['bank_dp'] = $soAwal->id_bank;        
            
        for($ii = 0; $ii < count($request->metode_pembayaran_putus) ; $ii++) {
            $id_bank = $request->jenis_bank[$ii];
            $nominal_pembayaran = $request->nominal_pembayaran[$ii];
            $metode_pembayaran = $request->metode_pembayaran_putus[$ii];
            if ($nominal_pembayaran != null) {
                if ($id_bank === null) {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => 'tunai',
                        'id_slip_order' => $soAwal->id_slip_order.'A',
                        'id_customer' => $soAwal->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => '-',
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }else {
                    Pembayaran::create([
                        'tanggal_pembayaran' => $tanggalan,
                        'keterangan_pembayaran' => 'Pembayaran Jual Putus',
                        'metode_pembayaran' => $metode_pembayaran,
                        'id_slip_order' => $soAwal->id_slip_order.'A',
                        'id_customer' => $soAwal->id_customer,
                        'id_staf' => $request->id_staf,
                        'id_bank' => $id_bank,
                        'nominal_pembayaran'=>$nominal_pembayaran
                    ]);
                }                    
            }                 
        }

        $SO['jenis_bank2'] = $request->jenis_bank;
        $SO['nominal_pembayaran2'] = $request->nominal_pembayaran;             
        $SO['tipe_penjualan'] = 'HAK MILIK';
        $SO['referensi_invoice'] = $soAwal->id_slip_order;        
        $SO['sisa_tagihan'] = $request->total_cart - $jumlah_pembayaran;  
        $SO['total_cart'] = $request->total_cart;  
        $SO['remark'] = $request->remark;        
        $SO['status_recurring'] = "Jual Putus";
        $SO['status_upgrade'] = "Upgrade";
        SlipOrder::create($SO);
        
        $maintenance['id_slip_order'] =  $soAwal->id_slip_order.'A';
        $maintenance['id_customer'] =  $soAwal->id_customer;
        Maintenance::create($maintenance);
        
        $soAwal->delete();        

        $message = 'Upgrade Success';
        return redirect()->route('slipOrder.indexPutus')->withMessage($message);       
    }

    public function dataManager(){     
        $manager = SalesManager::orderBy('nama_manajer', 'asc')->get();
        return view('slipOrder.dataManager',compact('manager'));
    }

    public function dataSales($id){     
        $sales = Sales::where('id_manajer','=',$id)->orderBy('nama_sales', 'asc')->get();
        return view('slipOrder.dataSales',compact('sales'));
    }

    public function dataPenjualanSales($id){     
        $penjualan = SlipOrder::where('nama_seller','=',$id)->get();
        return view('slipOrder.penjualanSales',compact('penjualan'));
    }

    public function getImportSO(){
        return view('slipOrder.formImportSO');
    }

    public function postImportSO(Request $request) {
        Excel::import(new Slip_ordersImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }
    
    public function getImportSODetail(){
        return view('slipOrder.formImportSODetail');
    }

    public function postImportSODetail(Request $request) {
        Excel::import(new Slip_order_detailImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('indexSlipOrderNew')->withMessage($message);
    }

    

}
