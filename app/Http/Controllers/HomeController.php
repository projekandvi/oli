<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Transaction;
use App\Lead;
use App\Customer;
use App\Barang;
use App\Invoice;
use App\Instalasi;
use App\Tiket;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.home');
    }
    public function aboutus()
    {
        return view('frontend.aboutus');
    }
    public function methods()
    {
        return view('frontend.methods');
    }
    public function belajar()
    {
        return view('frontend.belajar');
    }
    public function partners()
    {
        return view('frontend.partners');
    }
    public function store()
    {
        return view('frontend.store');
    }
    public function news()
    {
        return view('frontend.news');
    }
    public function signup()
    {
        return view('frontend.signup');
    }

    public function top5()
    {
        $lala = \DB::table('transactions')
        ->select(\DB::raw("COUNT('transactions.destination_id') AS dest_count"))
        ->orderBy('dest_count', 'desc')
        ->groupBy('transactions.destination_id')
        ->take(5)
        ->get()->toArray();

        // dd($lala);
    }
    // public function getIndex()
    // {            
    //     $lead = Lead::count();      
    //     $customer = Customer::count();      
    //     $barang = Barang::sum('stok');      
    //     $invoiceTotal = Invoice::sum('total_cart');      
    //     $invoice = Invoice::count();      
    //     $tiket = Tiket::where('status_tiket','=','Belum Tertangani')->count();      
    //     $instalasi = Instalasi::count();      
    //     $delivery = Instalasi::count();      
    //     $staf = Instalasi::count();      
    //     return view('home',compact('tiket','lead','customer','barang','invoice','invoiceTotal','instalasi','delivery','staf'));  
        
        
    // }
    public function getIndex()
    {                
        return view('metro'); 
    }
}
