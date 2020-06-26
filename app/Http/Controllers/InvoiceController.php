<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\SlipOrder;
use App\Customer;
use App\Barang;
use App\Payment;
use App\Instalasi;
use App\TemporaryInvoice;
use App\Tampung;
use App\Http\Requests\InvoiceRequest;
use DB;
use Carbon\Carbon;
use Darryldecode\Cart\CartCondition;
use Cart;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Exports\InvoicePutusExport;

class InvoiceController extends Controller
{
    private $searchParams = ['invoice_no','customer','from','to'];
    
    public function getIndex(Request $request)
    {     
        
        return view('slipOrder.indexSlipOrder');
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InvoiceController@getIndex', $params);
    }
    
    public function getIndexSewa(Request $request)
    {     
        $customers =  Customer::orderBy('nama_customer', 'asc')
                                ->pluck('nama_customer', 'id');

        $sewa = Invoice::where('tipe_penjualan','=','Sewa')->orderBy('id_invoice', 'asc');        
        
        if($request->get('invoice_no')) {
            $sewa->where('id_invoice', 'LIKE', '%' . $request->get('invoice_no') . '%');
        }

        if($request->get('customer')) {
            $sewa->where('id_customer', 'LIKE', '%' . $request->get('customer') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $sewa->whereBetween('tanggal',[$from,$to]);
            }else{
                $sewa->where('tanggal','<=',$to);
            }
        } 
        
        $cloneTransactionForNetTotal = clone $sewa;
        $net_total = $cloneTransactionForNetTotal->sum('total_cart');

        return view('invoice.indexSewa')
        ->withSewa($sewa->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndexSewa(Request $request) 
    {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InvoiceController@getIndexSewa', $params);
    }
    
    public function getIndexPutus(Request $request)
    {     
        $customers =  Customer::orderBy('nama_customer', 'asc')
                                ->pluck('nama_customer', 'id');

        $putus = Invoice::where('tipe_penjualan','=','Beli Putus')->orderBy('id_invoice', 'asc');        
        
        if($request->get('invoice_no')) {
            $putus->where('id_invoice', 'LIKE', '%' . $request->get('invoice_no') . '%');
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

        return view('invoice.indexPutus')
        ->withPutus($putus->paginate(10))
        ->with('net_total', $net_total)
        ->withCustomers($customers);
    }

    public function postIndexPutus(Request $request) 
    {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('InvoiceController@getIndexPutus', $params);
    }

    public function getIndexAkunting(Request $request)
    {        
        // $invoices = Invoice::orderBy('id_invoice', 'asc');
        $total_invoice = SlipOrder::count();

        $total_transaksi = SlipOrder::get();
        
        $resultT = collect($total_transaksi)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksi = array_sum(array_column($resultT, 'total_cart'));            
            
        $sewa = SlipOrder::where('tipe_penjualan','=','Sewa')->count();

        $putus = SlipOrder::where('tipe_penjualan','=','Putus')->count();

        $total_transaksi_sewa = SlipOrder::where('tipe_penjualan','=','Sewa')->get();
        $resultTransaksi_sewa = collect($total_transaksi_sewa)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksiSewa = array_sum(array_column($resultTransaksi_sewa, 'total_cart'));
        
        $total_transaksi_putus= SlipOrder::where('tipe_penjualan','=','Putus')->get();
        $resultTransaksi_putus = collect($total_transaksi_putus)->map(function($value) {
            return [                
                'total_cart' => $value['total_cart']
            ]; })->all();
        $totalTransaksiPutus = array_sum(array_column($resultTransaksi_putus, 'total_cart'));

        // $sisaPembayaran = $totalTransaksi - $totalTransaksi_dibayar;
        // dd($total_invoice);
        if ($request->get('id_invoice')) {
            $customers->where(function($q) use($request) {
                $q->where('id_invoice', 'LIKE', '%' . $request->get('id_invoice') . '%');
            });
        }
        return view('akunting.indexAkunting',compact('total_invoice','totalTransaksi','totalTransaksiSewa','totalTransaksiPutus','sewa','putus'));
    }    

    public function getNewInvoice () 
    {
        $invoice = new Invoice;
        $nomor_otomatis = $this->autonumberInvoice();
        $tanggal_otomatis = $this->convertdate();
        $customers = Customer::get();

        $barangs = Barang::where('status_barang','=','Tersedia')
                          ->where('kondisi','!=','nama')
                          ->get();

        $lokasi = DB::table('lokasi_stoks')->pluck("lokasi_stok","id");        

        return view('invoice.form', compact('invoice','nomor_otomatis','tanggal_otomatis','customers','barangs','lokasi'));
    }
    
    public function getlokasi($id) 
    {        
        $barangs = DB::table("barangs")->where("id_lokasi_stok",$id)->where('status_barang','=','Tersedia')->pluck("nama_barang","id_barang");
        return json_encode($barangs);
    }

    public function getProduct($id)
    {
        $products = Customer::findOrFail($id);
        return response()->json($products, 200);
    }

    public function getBarang($id)
    {
        $barangs = Barang::findOrFail($id);
        return response()->json($barangs, 200);
    }

    public static function convertdate(){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('d/m/Y');
        return $date;
    }

    public function postInvoice(InvoiceRequest $request, Invoice $invoice)
    {
        
        $userId = 1;        
        // simpan cart ke database
        $items = Cart::session($userId)->getContent();
        
        $total_quantity = Cart::session($userId)->getTotalQuantity();
        $sub_total = Cart::session($userId)->getSubTotal();
        $total_cart = Cart::session($userId)->getTotal();

        $tanggalan = Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
        $lala = $this->autonumberInvoice();
        $invoice->id_invoice = $lala;
        $invoice->tanggal = $tanggalan;
        $invoice->id_staf = $request->id_staf;
        $invoice->id_customer = $request->id_customer;
        $invoice->team = $request->team;
        $invoice->nama_seller = $request->nama_seller;
        $invoice->lokasi_penjualan = $request->lokasi_penjualan;
        $invoice->lokasi_barang = $request->lokasi_barang;
        $invoice->crc_code = $request->crc_code;
        $invoice->la_code = $request->la_code;
        $invoice->nama_customer = $request->nama_customer;
        $invoice->no_ktp = $request->no_ktp;
        $invoice->alamat_ktp = $request->alamat_ktp;
        $invoice->alamat_pemasangan = $request->alamat_pemasangan;
        $invoice->milik_tempat_tinggal = $request->milik_tempat_tinggal;
        $invoice->no_telp = $request->no_telp;
        $invoice->no_hp = $request->no_hp;
        $invoice->email = $request->email;
        $invoice->harga = $request->harga;
        $invoice->metode_pembayaran = $request->metode_pembayaran;
        $invoice->jenis_bank = $request->jenis_bank;
        $invoice->nominal_pembayaran = $request->nominal_pembayaran;
        $invoice->tipe_penjualan = $request->tipe_penjualan;
        $invoice->periode_sewa = $request->periode_sewa;
        $invoice->nama_pemilik_kartu_recurring = $request->nama_pemilik_kartu_recurring;
        $invoice->jenis_bank_recurring = $request->jenis_bank_recurring;
        $invoice->jenis_kartu_kredit_recurring = $request->jenis_kartu_kredit_recurring;
        $invoice->nomor_kartu_recurring = $request->nomor_kartu_recurring;
        $invoice->nominal_debit_recurring = $request->nominal_debit_recurring;
        $invoice->tanggal_debit_recurring = $request->tanggal_debit_recurring;
        $invoice->masa_kartu_expired_recurring = $request->masa_kartu_expired_recurring;
        $invoice->id_barang = $request->id_barang;
        $invoice->pembayaran_terkini = $request->pembayaran_terkini;
        $invoice->nomor_kartu = $request->nomor_kartu;
        $invoice->masa_kartu_expired = $request->masa_kartu_expired;
        $invoice->referensi_invoice = $lala;        
        $invoice->total_cart = $total_cart;        

        if ($request->status_pelunasan === 'Sewaan') {
            $invoice->sisa_tagihan = 0;
        } else {
            $invoice->sisa_tagihan = $total_cart - $request->jumlah;
        }        
        
        if ($request->cicilan === "-- Cicilan --") {
            $invoice->cicilan = "lunas";
        } else {
            $invoice->cicilan = $request->cicilan;
        }

        if ($invoice->sisa_tagihan <= 0) {            
        $invoice->status_pelunasan = "LUNAS";
        } else {
            $invoice->status_pelunasan = "BELUM LUNAS";
        }

        // dd($invoice);
        $invoice->save();        

        $isi = array();
        // data instalasi
            $instalasi['id_invoice'] = $lala;
            $instalasi['id_customer'] = $request->id_customer;
            foreach($items as $item)
            {            
                $isi[] = $item->name;
            }
            $instalasi['id_barang'] =  json_encode($isi);
            $instalasi['lokasi_barang'] = $request->lokasi_barang;
            $instalasi['alamat_pemasangan'] = $request->alamat_pemasangan;

            Instalasi::insert($instalasi);
        
        
        // dd($items);
        foreach($items as $item)
        {      
            $tampung['id_invoice'] =  $lala;
            $tampung['id_barang'] =  $item->id;   
            $tampung['nama_barang'] =  $item->name;      
            $tampung['price'] =  $item->price;      
            $tampung['qty'] =  $item->quantity;      

            Tampung::insert($tampung);

            $barang = Barang::where('id_barang','=',$item->id)->first();
            $barang->status_barang = $request->status_barang;
            $barang->stok = $barang->stok - $item->quantity;
            $barang->save();
        }        

        Cart::session($userId)->clear();

        // data pembayaran
        $bayar['id_invoice'] = $lala;
        $bayar['id_customer'] = $request->id_customer;
        $bayar['id_staf'] = $request->id_staf;
        $bayar['metode_pembayaran'] = $request->metode_pembayaran;
        $bayar['jenis_bank'] = $request->jenis_bank;
        $bayar['jumlah'] = $request->jumlah;
        $bayar['catatan'] = $request->catatan;
        Payment::insert($bayar);

        $message = 'changes saved';
        return redirect()->route('akunting.index')->withMessage($message);
    }

    public static function autonumberInvoice()
    {
        $q=DB::table('invoices')->select(DB::raw('MAX(RIGHT(id_invoice,5)) as kd_max'));
        $prx='SO-';
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = "00001";
        }

        return $kd;
    }

    

    public function getInvoiceDetails(Invoice $invoice)
    {
        $pembayaran = Payment::where('id_invoice','=',$invoice->id_invoice)->get();
        return view('invoice.details',compact('pembayaran'))->withInvoice($invoice);
    }

    // public function deleteCustomer(Customer $customer)
    // {
    //     $customer->delete();
    //     $message = 'Deleted';
    //     return redirect()->back()->withMessage($message);
    // }

    public function bayar(Request $request)
    {       
        $data['id_invoice'] = $request->id_invoice;
        $data['id_customer'] = $request->id_customer;
        $data['id_staf'] = $request->id_staf;
        $data['metode_pembayaran'] = $request->metode_pembayaran;
        $data['jenis_bank'] = $request->jenis_bank;
        $data['jumlah'] = $request->jumlah;
        $data['catatan'] = $request->catatan;
        Payment::insert($data);

        $sisa_tagihannya = Invoice::where('id_invoice','=',$request->id_invoice)->pluck('sisa_tagihan')->first();

        Invoice::where('id_invoice',$request->id_invoice)->update([
            'sisa_tagihan' =>$sisa_tagihannya-$request->jumlah,
        ]);        

        $message = 'changes saved';
        return redirect('SO/'.$request->id_invoice.'/details')->withMessage($message);
    }

    public function getEditSalesOrder(Invoice $invoice)
    {   
        $customers = Customer::get();
        $lokasi = DB::table('lokasi_stoks')->pluck("lokasi_stok","id");
        $barangs = Barang::where('status_barang','=','Tersedia')
        ->where('kondisi','!=','nama')
        ->get();
        // dd($invoice);
        return view('invoice.edit',compact('customers','lokasi','barangs'))->withInvoice($invoice);  
    }


    public function postEditSalesOrder(Request $request)
    {
        $invoice['id_invoice'] = $request->id_invoice;
        $invoice['tanggal'] = $request->tanggal;
        $invoice['id_staf'] = $request->id_staf;
        $invoice['id_customer'] = $request->id_customer;
        $invoice['team'] = $request->team;
        $invoice['nama_seller'] = $request->nama_seller;
        $invoice['lokasi_penjualan'] = $request->lokasi_penjualan;
        $invoice['lokasi_barang'] = $request->lokasi_barang;
        $invoice['crc_code'] = $request->crc_code;
        $invoice['la_code'] = $request->la_code;
        $invoice['nama_customer'] = $request->nama_customer;
        $invoice['no_ktp'] = $request->no_ktp;
        $invoice['alamat_ktp'] = $request->alamat_ktp;
        $invoice['alamat_pemasangan'] = $request->alamat_pemasangan;
        $invoice['milik_tempat_tinggal'] = $request->milik_tempat_tinggal;
        $invoice['no_telp'] = $request->no_telp;
        $invoice['no_hp'] = $request->no_hp;
        $invoice['email'] = $request->email;
        $invoice['harga'] = $request->harga;
        $invoice['metode_pembayaran'] = $request->metode_pembayaran;
        $invoice['jenis_bank'] = $request->jenis_bank;
        $invoice['nominal_pembayaran'] = $request->nominal_pembayaran;
        $invoice['tipe_penjualan'] = $request->tipe_penjualan;
        $invoice['status_pelunasan'] = $request->status_pelunasan;
        $invoice['periode_sewa'] = $request->periode_sewa;
        $invoice['nama_pemilik_kartu_recurring'] = $request->nama_pemilik_kartu_recurring;
        $invoice['jenis_bank_recurring'] = $request->jenis_bank_recurring;
        $invoice['jenis_kartu_kredit_recurring'] = $request->jenis_kartu_kredit_recurring;
        $invoice['nomor_kartu_recurring'] = $request->nomor_kartu_recurring;
        $invoice['nominal_debit_recurring'] = $request->nominal_debit_recurring;
        $invoice['tanggal_debit_recurring'] = $request->tanggal_debit_recurring;
        $invoice['masa_kartu_expired_recurring'] = $request->masa_kartu_expired_recurring;
        $invoice['id_barang'] = $request->id_barang;
        $invoice['pembayaran_terkini'] = $request->pembayaran_terkini;
        $invoice['nomor_kartu'] = $request->nomor_kartu;
        $invoice['masa_kartu_expired'] = $request->masa_kartu_expired;
        $invoice['referensi_invoice'] = $request->id_invoice;        

        TemporaryInvoice::insert($invoice);

        $message = 'changes saved';
        return redirect()->back()->withMessage($message);
    }

    public function excel_export(Request $request) 
    {
        $tanggal_otomatis = $this->convertdate();
        $invoice_no = $request->invoice_no;
        $customer = $request->customer;
        $dari = $request->from;
        $ke = $request->to;
        $headings = [
            'INV', 
            'nama customer', 
            'alamat',
        ];
        $date='2018-06-15 11:54:07';
        // return (new TransactionsExport($date,$headings))->download($date.'_inventory.xlsx');
        return Excel::download(new InvoicePutusExport($invoice_no,$customer,$dari,$ke,$tanggal_otomatis,$headings), 'laporan.xlsx');

    }

    // public function pdf_export(Request $request)
    // {
    //     $dari = $request->from;
    //     $ke = $request->to;
    //     $transaction = Invoice::select('id_invoice','nama_customer')->whereBetween('created_at', [$dari.' 00:00:00',$ke.' 23:59:59'])->get();
    //     // dd($transaction);
    //     $per = $dari.' s/d '.$ke;
    //     $pdf = PDF::loadview('report.transaction_pdf',['transactions'=>$transaction,'periode'=>$per]);
    //     return $pdf->download('laporan-penjualan-'.$per.'-pdf');
    // }

// ----------------------------------akhir fungsi---------------------------------------------------------------------
}
