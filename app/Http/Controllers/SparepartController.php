<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sparepart;
use App\Http\Requests\SparepartRequest;
use DB;

class SparepartController extends Controller
{
    
    private $searchParams = ['nama_sparepart'];
    public function getIndex(Request $request)
    {
        
            $spareparts = Sparepart::orderBy('nama_sparepart', 'asc');
            if ($request->get('nama_sparepart')) {
                $spareparts->where(function($q) use($request) {
                    $q->where('nama_sparepart', 'LIKE', '%' . $request->get('nama_sparepart') . '%');
                });
            }
        return view('sparepart.index')->withspareparts($spareparts->paginate(20));
    }

    public function postIndex(Request $request) {
        $params = array_filter($request->only($this->searchParams));
        return redirect()->action('SparepartController@getIndex', $params);
    }

    public function getNewSparepart () {
        $sparepart = new Sparepart;
        return view('sparepart.form', compact('sparepart'));
    }

    public function postSparepart(SparepartRequest $request, Sparepart $sparepart)
    {
        $sparepart->id_sparepart = $this->autonumber();
        $sparepart->kode_sparepart = $request->get('kode_sparepart');
        $sparepart->nama_sparepart = $request->get('nama_sparepart');
        $sparepart->harga = $request->get('harga');
        $sparepart->kondisi = $request->get('kondisi');
        $sparepart->lokasi_stok = $request->get('lokasi_stok');

        $sparepart->save();

        $message = 'changes saved';
        return redirect()->route('sparepart.index')->withMessage($message);

    }

    public function getEditSparepart(Sparepart $sparepart)
    {   
        $current_locale = app()->getLocale();
        \App::setLocale('ar');
        $secondary_lang = \Lang::get('core');
        \App::setLocale($current_locale);

        return view('sparepart.form')
                ->withSparepart($sparepart)
                ->with('secondary_lang',$secondary_lang);
    }

    public function getSparepartDetails(Sparepart $sparepart)
    {   
        return view('sparepart.details')->withSparepart($sparepart);
    }

    public function deleteSparepart(Sparepart $sparepart)
    {
        $sparepart->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
        
    }

    public static function autonumber(){
        $q=DB::table('spareparts')->select(DB::raw('MAX(RIGHT(id_sparepart,5)) as kd_max'));
        $prx='S-';
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%05s", $tmp);
            }
        }
        else
        {
            $kd = $prx."00001";
        }

        return $kd;
    }
}
