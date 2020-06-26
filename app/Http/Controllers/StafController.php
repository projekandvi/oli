<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SalesManager;
use App\Sales;
use App\Teknisi;
use App\SlipOrder;
use DB;
use Response;
use Auth;
use Carbon\Carbon;
use App\Imports\UsersImport;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class StafController extends Controller
{
    private $searchParams = ['name'];

    public function getIndex(Request $request){        
        $users = User::orderBy('name', 'asc');
        if ($request->get('name')) {
            $users->where(function($q) use($request) {
                $q->where('name', 'LIKE', '%' . $request->get('name') . '%');
            });
        }
        return view('user.index')->withusers($users->paginate(20));
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('UserController@getIndex', $params);
    }

    public function getNewUser () {
        $user = new User;
        return view('user.form', compact('user'));
    }

    public function postUser(UserRequest $request, User $user){
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->save();

        $message = 'changes saved';
        return redirect()->route('user.index')->withMessage($message);
    }

    public function getEditUser(User $user){   
        return view('user.form')->withUser($user);
    }

    public function getUserDetails(User $user){   
        return view('user.details')->withBarang($user);
    }

    public function deleteUser(User $user){
        $user->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
    }

    // simpan sales manager
    public function postSalesManager(Request $request){   
        $sm['nama_manajer'] = $request->nama_manajer;       
        SalesManager::create($sm);  
        
        return redirect()->back();
    }

    // simpan sales 
    public function postSales(Request $request){   
        $sm['id_manajer'] = $request->id_manajer;       
        $sm['nama_sales'] = $request->nama_sales;         
        Sales::create($sm);  
        
        return redirect()->back();
    }

    public function simpanNewSalesManager(Request $request){
        $newSalesManager['nama_manajer'] =  $request->nama_manajer;    
        SalesManager::create($newSalesManager);
        return response()->json(200);
    }

    public function simpanNewSales(Request $request){
        $newSales['id_manajer'] =  $request->id_manajer;    
        $newSales['nama_sales'] =  $request->nama_sales;      
        $newSales['agency_code'] = $request->agency_code;   
        Sales::create($newSales);
        return response()->json(200);
    }

   public function getSales(){
        $sales = Sales::all();
        return response()->json($sales, 200);
    }

   public function getSalesManager(){
        $salesManagers = SalesManager::all();
        return response()->json($salesManagers, 200);
    }

    public function getSalesPilihan($id) {        
        $sales = DB::table("sales")->where("id_manajer",$id)->pluck("nama_sales","id");
        return json_encode($sales);
    }

    public function getAgency($id) {
        $agencys = Sales::findOrFail($id);
        return response()->json($agencys, 200);
    }

    public function getImportUser(){
        return view('staf.formImportUser');
    }

    public function postImportUser(Request $request) {
        Excel::import(new UsersImport, $request->file('unggahan'));

        $message = 'Upload Success';
        return redirect()->route('user.index')->withMessage($message);
    }

    public function simpanNewTeknisi(Request $request){
        $newTeknisi['nama_teknisi'] =  $request->nama_teknisi;    
        Teknisi::create($newTeknisi);
        return response()->json(200);
    }

    public function getTeknisi(){
        $teknisis = Teknisi::all();
        return response()->json($teknisis, 200);
    }

    // data penjualan 

    // public function dataSales($id){     
    //     $sales = Sales::where('id_manajer',Auth::user()->id)->orderBy('nama_sales', 'asc')->get();
    //     return view('staf.dataSales',compact('sales'));
    // }

    public function dataSales($id){     
        $vp = SalesManager::where('id','=',$id)->first();
        $sales = Sales::where('id_manajer','=',$id)->orderBy('nama_sales', 'asc')->get();
        return view('staf.dataSales',compact('sales','vp'));
    }

    public function salesReportExcel($id) {
        $tanggalan = Carbon::now()->format('d-m-Y');
        return Excel::download(new SalesReportExport($id), 'Laporan Penjualan - '.$tanggalan.'.xlsx');
    }

    public function dataPenjualanSales($id){     
        $penjualan = SlipOrder::where('nama_seller','=',$id)->get();
        return view('staf.penjualanSales',compact('penjualan'));
    }

    

}
