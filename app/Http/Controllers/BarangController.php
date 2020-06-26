<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Sparepart;
use App\Gudang;
use App\LokasiStok;
use App\LokasiBarang;
use App\Http\Requests\BarangRequest;
use File;
use DB;
use Carbon\Carbon;
use App\Imports\BarangsImport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    private $searchParams = ['id_barang','kode_barang','nama_barang','from','to'];
    
    public function getIndex(Request $request){     
        $tersedia = Barang::orderBy('id_barang', 'asc');        
        
        if($request->get('id_barang')) {
            $tersedia->where('id_barang', 'LIKE', '%' . $request->get('id_barang') . '%');
        }
        
        if($request->get('kode_barang')) {
            $tersedia->where('kode_barang', 'LIKE', '%' . $request->get('kode_barang') . '%');
        }

        if($request->get('nama_barang')) {
            $tersedia->where('nama_barang', 'LIKE', '%' . $request->get('nama_barang') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $tersedia->whereBetween('created_at',[$from,$to]);
            }else{
                $tersedia->where('created_at','<=',$to);
            }
        } 
        
        $cloneTersediaForTotal = clone $tersedia;
        $totalBarangTersedia = $cloneTersediaForTotal->sum('stok');

        return view('barang.indexBarang')
        ->withTersedia($tersedia->paginate(10))
        ->with('totalBarangTersedia', $totalBarangTersedia);
     }
 
     public function postIndex(Request $request) {
         $params = array_filter($request->only($this->searchParams));
         return redirect()->action('BarangController@getIndex', $params);
     }

     // ----------------------------------------------------------------tersedia--------------------------------------------------------------

     public function getIndexTersedia(Request $request) {     
         $tersedia = Barang::where('status_barang','=','Tersedia')
         ->where('kondisi','!=','nama')->orderBy('id_barang', 'asc');        
         
         if($request->get('id_barang')) {
             $tersedia->where('id_barang', 'LIKE', '%' . $request->get('id_barang') . '%');
         }
         
         if($request->get('kode_barang')) {
             $tersedia->where('kode_barang', 'LIKE', '%' . $request->get('kode_barang') . '%');
         }
 
         if($request->get('nama_barang')) {
             $tersedia->where('nama_barang', 'LIKE', '%' . $request->get('nama_barang') . '%');
         }
 
         $from = $request->get('from');
         $to = $request->get('to')?:date('Y-m-d');
         $to = Carbon::createFromFormat('Y-m-d',$to);
 
         if($request->get('from') || $request->get('to')) {
             if(!is_null($from)){
                 $from = Carbon::createFromFormat('Y-m-d',$from);
                 $tersedia->whereBetween('created_at',[$from,$to]);
             }else{
                 $tersedia->where('created_at','<=',$to);
             }
         } 
         
         $cloneTersediaForTotal = clone $tersedia;
         $totalBarangTersedia = $cloneTersediaForTotal->count('nama_barang');
 
         return view('barang.barangTersedia')
         ->withTersedia($tersedia->paginate(10))
         ->with('totalBarangTersedia', $totalBarangTersedia);
     }
 
     public function postIndexTersedia(Request $request) {
         $params = array_filter($request->only($this->searchParams));
         return redirect()->action('BarangController@getIndexTersedia', $params);
     }

    // ----------------------------------------------------------------tersewa--------------------------------------------------------------

    public function getIndexTersewa(Request $request)
    {     
        $tersewa = Barang::where('status_barang','=','Tersewa')
        ->where('kondisi','!=','nama')->orderBy('id_barang', 'asc');        
        
        if($request->get('id_barang')) {
            $tersewa->where('id_barang', 'LIKE', '%' . $request->get('id_barang') . '%');
        }
        
        if($request->get('kode_barang')) {
            $tersewa->where('kode_barang', 'LIKE', '%' . $request->get('kode_barang') . '%');
        }

        if($request->get('nama_barang')) {
            $tersewa->where('nama_barang', 'LIKE', '%' . $request->get('nama_barang') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $tersewa->whereBetween('created_at',[$from,$to]);
            }else{
                $tersewa->where('created_at','<=',$to);
            }
        } 
        
        $cloneTersewaForTotal = clone $tersewa;
        $totalBarangTersewa = $cloneTersewaForTotal->count('nama_barang');

        return view('barang.barangTersewa')
        ->withTersewa($tersewa->paginate(10))
        ->with('totalBarangTersewa', $totalBarangTersewa);
    }

    public function postIndexTersewa(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('BarangController@getIndexTersewa', $params);
    }
   
    // ----------------------------------------------------------------terbeli--------------------------------------------------------------

    public function getIndexTerbeli(Request $request){     
        $terbeli = Barang::where('status_barang','=','Terbeli')
        ->where('kondisi','!=','nama')->orderBy('id_barang', 'asc');        
        
        if($request->get('id_barang')) {
            $terbeli->where('id_barang', 'LIKE', '%' . $request->get('id_barang') . '%');
        }
        
        if($request->get('kode_barang')) {
            $terbeli->where('kode_barang', 'LIKE', '%' . $request->get('kode_barang') . '%');
        }

        if($request->get('nama_barang')) {
            $terbeli->where('nama_barang', 'LIKE', '%' . $request->get('nama_barang') . '%');
        }

        $from = $request->get('from');
        $to = $request->get('to')?:date('Y-m-d');
        $to = Carbon::createFromFormat('Y-m-d',$to);

        if($request->get('from') || $request->get('to')) {
            if(!is_null($from)){
                $from = Carbon::createFromFormat('Y-m-d',$from);
                $terbeli->whereBetween('created_at',[$from,$to]);
            }else{
                $terbeli->where('created_at','<=',$to);
            }
        } 
        
        $cloneTerbeliForTotal = clone $terbeli;
        $totalBarangTerbeli = $cloneTerbeliForTotal->count('nama_barang');

        return view('barang.barangTerbeli')
        ->withTerbeli($terbeli->paginate(10))
        ->with('totalBarangTerbeli', $totalBarangTerbeli);
    }

    public function postIndexTerbeli(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('BarangController@getIndexTerbeli', $params);
    }

    public function getIndexGudang(Request $request){     
        $gudang = Gudang::orderBy('id', 'asc');        
        
        if($request->get('nama_gudang')) {
            $tersedia->where('nama_barang', 'LIKE', '%' . $request->get('nama_barang') . '%');
        }
        return view('barang.indexGudang')->withGudang($gudang->paginate(10));
    }

    public function postIndexGudang(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('BarangController@getIndexGudang', $params);
    }

    public function getNewGudang () {
        return view('barang.formNewGudang');
    }

    public function postGudang(Request $request) {   
        $newGudang['nama_gudang'] =  $request->nama_gudang;    
        Gudang::create($newGudang);

        $message = 'new data saved';
        return redirect()->route('gudang.index')->withMessage($message);

    }

    public function getNewBarang () {
        $barang = new Barang;
        $kode_barang = $this->autonumber();
        $gudang = Gudang::get();
        return view('barang.form', compact('barang','kode_barang','gudang'));
    }

    public function postBarang(BarangRequest $request, Barang $barang){   
        $barang->id_barang = $request->get('id_barang');
        $barang->kode_barang = $request->get('kode_barang');
        $barang->nama_barang = $request->get('nama_barang');
        $barang->harga = $request->get('harga');
        $barang->stok = $request->get('stok');

        $barang->save();

        $lokasiBarang['id_barang'] = $request->get('id_barang');
        $lokasiBarang['id_gudang'] = $request->get('id_gudang');
        $lokasiBarang['stok'] = $request->get('stok');
        LokasiBarang::create($lokasiBarang);

        $message = 'changes saved';
        return redirect()->route('barang.index')->withMessage($message);
    }

    public function postStok(BarangRequest $request, Barang $barang){   
        $barang->stok = $barang->stok + $request->get('stok');

        $barang->save();

        $message = 'changes saved';
        return redirect()->route('barang.index')->withMessage($message);

    }

    public function postAddSparepart(Request $request){
        foreach($request->id_sparepart as $field) {
            Sparepart::where('id_sparepart',$field)->update([                
                'id_barang' =>$request->id_barang,
            ]);
        }
        
        $message = 'changes saved';
        return redirect()->route('barang.index')->withMessage($message);
    }

    public function getBarangSparepart(Barang $barang){   
        $spareparts = Sparepart::whereNull('id_barang')->pluck('nama_sparepart','id_sparepart');
        
        return view('barang.formSparepart')
                ->withBarang($barang)
                ->withSpareparts($spareparts);
    }

    public function getBarangGudang($id){   
        $lokasi = LokasiBarang::where('id_gudang','=',$id)->paginate(10);
        $gudangnya = Gudang::where('id','=',$id)->first();
        
        $cloneTersediaForTotal = clone $lokasi;
        $totalBarangTersedia = $cloneTersediaForTotal->sum('stok');
        
        return view('barang.indexBarangGudang',compact('lokasi','totalBarangTersedia','gudangnya'));
    }

    public function getEditDataBarang(Barang $barang) {   
        $lokasi_barang = LokasiBarang::get();
        return view('barang.formDataBarang',compact('lokasi_barang'))->withBarang($barang);
    }

    public function editDataSimpan(BarangRequest $request, Barang $barang){   
        $barang->kode_barang = $request->get('kode_barang');
        $barang->nama_barang = $request->get('nama_barang');
        $barang->harga = $request->get('harga');
        $barang->stok = $request->get('stok');

        $barang->save();

        $message = 'changes saved';
        return redirect()->route('barang.index')->withMessage($message);

    }



    public function getUpdateStok(Barang $barang) {   
        $lokasi_barang = LokasiBarang::get();
        return view('barang.formStok',compact('lokasi_barang'))->withBarang($barang);
    }

    public function getBarangDetails(Barang $barang) {   
        return view('barang.details')->withBarang($barang);
    }

    public function deleteBarang(Barang $barang) {
        $barang->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);        
    }

    public static function autonumber(){
        $q=DB::table('barangs')->select(DB::raw('MAX(RIGHT(id_barang,5)) as kd_max'));
        $prx='B-';
        if($q->count()>0) {
            foreach($q->get() as $k) {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%05s", $tmp);
            }
        }
        else  {
            $kd = $prx."00001";
        }
        return $kd;
    }

    public function getBarang($id){
        $barangs = Barang::findOrFail($id);
        return response()->json($barangs, 200);
    }

    public function getImportBarang(){
        return view('barang.formImportBarang');
    }

    public function postImportBarang(Request $request) {
        Excel::import(new BarangsImport, $request->file('unggahan'));

        $message = 'Upload Success';

        return redirect()->route('barang.index')->withMessage($message);
    }

}
