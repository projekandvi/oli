<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Customer;
use App\Reference;
use App\Batch;
use App\Pulsa;
use App\Jual_beli;
use App\Refinancing;
use App\Umroh;
use App\Http\Resources\Transaction\TransactionResource;
use Illuminate\Http\Response;
use App\Discount;
use Carbon\Carbon;
use DB;
use App\Destination;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailJualBeli;
use App\Mail\SendMailRefinancing;
use App\Mail\SendMailUmroh;
use File;

class ApiTransactionController extends Controller
{
    public function index()
    {
        $Transaction = Transaction::get();

        return response()->json([  'data'=>$Transaction ]);
    }
	
	 public function mytickets(Request $request)
    {
        $Transaction = Transaction::where('customer_id','=', $request->customer_id)->where('gate_status','=', 0)->with(['destination'])->with(['customer'])->get();

        return response()->json([  'data'=>$Transaction ]);
    }

    public function history(Request $request)
    {
        $Transaction = Transaction::where('customer_id','=', $request->customer_id)->where('gate_status','=', 1)->with(['destination'])->with(['customer'])->get();

        return response()->json([  'data'=>$Transaction ]);
    }

	public function simpanTransaksi(Request $request)
    {
		$faker = Faker::create();
        $current_time = Carbon::now('Asia/Jakarta');
        $tujuan = Destination::where('id','=',$request->destination_id)->first();
        $pajak = 0;

        $total_sebelum_diskon = $tujuan->price * $request->qty;
        $total_sebelum_pajak = $total_sebelum_diskon - (($request->discount/100) * $total_sebelum_diskon);
		
		$dataCustomer = Customer::where('id','=', $request->customer_id)->first();		
		
		$namanya = $dataCustomer->first_name;
		$gendernya = $dataCustomer->gender;
		$negaranya = $dataCustomer->negara;
		$kerjaannya = $dataCustomer->occupation;
		
        $tujuanya = $tujuan->name;
        
        $age = Carbon::parse($dataCustomer->birth_date)->age;
        
        $Transaction = Transaction::create([
            // 'inv' => $faker->ean8,
            'inv' => $this->autonumber($request->destination_id),
            'destination_id' => $request->destination_id,
			'destination_name' => $tujuanya,
            'customer_id' => $request->customer_id,
			'customer_name' => $namanya,
            'price' => $tujuan->price,
            'qty' => $request->qty,
            'total_cost_price' => $total_sebelum_diskon,
            'discount' => $request->discount,
            'total' => $total_sebelum_pajak,
            'invoice_tax' => 0.1,
            'total_tax' => $total_sebelum_pajak * 0.1,
            'net_tax' => $total_sebelum_pajak + ($total_sebelum_pajak* 0.1),
			'booking_date' => $request->booking_date,
            'age' => $age,
            'gender' => $gendernya,
            'region' => $negaranya,
            'occupation' => $kerjaannya,
            'created_at' => $current_time
            ]);

        return response(new TransactionResource($Transaction), Response::HTTP_CREATED);
    }

	public function simpanTransaksiPulsa(Request $request)
    {
		$faker = Faker::create();
        $current_time = Carbon::now('Asia/Jakarta');
        $tujuan = Destination::where('id','=',$request->destination_id)->first();
        $pajak = 0;

        $total_sebelum_diskon = $tujuan->price * $request->qty;
        $total_sebelum_pajak = $total_sebelum_diskon - (($request->discount/100) * $total_sebelum_diskon);
		
		$dataCustomer = Customer::where('id','=', $request->customer_id)->first();		
		
		$namanya = $dataCustomer->first_name;
		$gendernya = $dataCustomer->gender;
		$negaranya = $dataCustomer->negara;
		$kerjaannya = $dataCustomer->occupation;
		
        $tujuanya = $tujuan->name;
        
        $age = Carbon::parse($dataCustomer->birth_date)->age;
        
        $Transaction = Transaction::create([
            // 'inv' => $faker->ean8,
            'inv' => $this->autonumberPulsa(177467),
            'destination_id' => $request->destination_id,
			'destination_name' => $tujuanya,
            'customer_id' => $request->customer_id,
			'customer_name' => $namanya,
            'price' => $tujuan->price,
            'qty' => $request->qty,
            'total_cost_price' => $total_sebelum_diskon,
            'discount' => $request->discount,
            'total' => $total_sebelum_pajak,
            'invoice_tax' => 0.1,
            'total_tax' => $total_sebelum_pajak * 0.1,
            'net_tax' => $total_sebelum_pajak + ($total_sebelum_pajak* 0.1),
			'booking_date' => $request->booking_date,
            'age' => $age,
            'gender' => $gendernya,
            'region' => $negaranya,
            'occupation' => $kerjaannya,
            'created_at' => $current_time
            ]);

        return response(new TransactionResource($Transaction), Response::HTTP_CREATED);
    }

    public function gateIn(Request $request)
    {
        $cekTransaksi = Transaction::where('inv',$request->inv)->first();

        if ($cekTransaksi->gate_status == 0) {

            Transaction::where('inv',$cekTransaksi->inv)->update([
                'gate_status' => 1
            ]);   

            return response()->json(['code' => '00']); 

        } else {

            return response()->json(['code' => '40']);
            
        }
    }

    public static function autonumber($dest){

        $inisial = Destination::where('id',$dest)->first();
        $inisialnya = $inisial->short_name;

        $q=DB::table('transactions')->select(DB::raw('COUNT(inv) as kd_max'))->where('destination_id','=',$dest);
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ($k->kd_max)+1;
                $kd = sprintf($inisialnya."-INV-%d", $tmp);
            }
        }
        else
        {
            $kd = $inisialnya."-INV-1";
        }

        return $kd;
    }


    public static function autonumberPulsa($dest){

        $inisial = Destination::where('id',$dest)->first();
        $inisialnya = $inisial->short_name;

        $q=DB::table('transactions')->select(DB::raw('COUNT(inv) as kd_max'))->where('destination_id','=',$dest);
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ($k->kd_max)+1;
                $kd = sprintf($inisialnya."-INV-%d", $tmp);
            }
        }
        else
        {
            $kd = $inisialnya."-INV-1";
        }

        return $kd;
    }


    public static function autonumberinvoiceOVO($dest){

        $inisial = Destination::where('id',$dest)->first();
        $inisialnya = $inisial->short_name;

        $q=DB::table('tb_reference_number')->select(DB::raw('COUNT(inv) as kd_max'))->where('destination_id','=',$dest);
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ($k->kd_max)+1;
                $kd = sprintf($inisialnya."-INV-%d", $tmp);
            }
        }
        else
        {
            $kd = $inisialnya."-INV-1";
        }

        return $kd;
    }


    public function referenceNumber($destination)
    {
        $current_time = Carbon::now('Asia/Jakarta');

        $batch =  DB::table('tb_batch_number')->latest('created_at')->first();
        $batchnya = $batch->batch_number;

        $q=DB::table('tb_reference_number')->select(DB::raw('COUNT(id) as kd_max'))->where('batch_number','=',$batchnya);
        
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ($k->kd_max)+1;
                $kd = sprintf("%d", $tmp);
                $inv = $this->autonumberinvoiceOVO($destination);

                Reference::create([
                    'reference_number' => $kd,
                    'batch_number' => $batchnya,
                    'inv' => $this->autonumberinvoiceOVO($destination),
                    'destination_id' => $destination,
                    'created_at' => $current_time->toDateString()
                    ]);

            }
        }
        else
        {
            $kd = "1";
            $inv = $this->autonumberinvoiceOVO($destination);
            Reference::create([
                'reference_number' => $kd,
                'batch_number' => $batchnya,
                'inv' => $this->autonumberinvoiceOVO($destination),
                'destination_id' => $destination,
                'created_at' => $current_time->toDateString()
                ]);

        }

        // return $kd;
        return array($kd, $inv);
        
    }

    
    
    public function generateNumberOvo(Request $request){

        $batch =  DB::table('tb_batch_number')->latest('created_at')->first();
        $batchnya = $batch->batch_number;

        $reference = $this->referenceNumber($request->destination_id);

        $output=array( "reference" => $reference[0], "batch" => $batchnya, "inv" => $reference[1] );
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));	
    }

    public function show ($id)
    {
        $Transaction = Transaction::Find($id);
        return response()->json(['data' => $Transaction]);
    }
    
    public function update (Request $request,$id)
    {
        $Transaction = Transaction::Find($id);
        $Transaction->update($request->all());
        return response(new TransactionResource($Transaction), Response::HTTP_CREATED);
    }

    public function destroy (Transaction $Transaction)
    {   
        $Transaction->delete();
        return response('Deleted', Response::HTTP_OK);
    }
	
	public function potongsaldo (Request $request)
    {       
        $updateSaldo = Customer::findOrFail($request->customer_id);  
        
        $saldoawal = $updateSaldo->saldo;
        $updateSaldo->saldo = $saldoawal - $request->potongan;
                   
		$updateSaldo->save();
	   
		$output=array( "code" => "200");
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));	   
    }
    

	public function getOperatorPulsa(Request $request)
    {
        $jsonObj= array();
        $Pulsas = Pulsa::where('operator','=', $request->operator)->where('kategori','=', 'pulsa')->orderBy('urutan', 'asc')->get();

            foreach($Pulsas as $data)
        {
			
			$row['id'] = $data['id'];
			$row['kode'] = $data['kode'];
 			$row['keterangan'] = $data['keterangan'];
 			$row['harga'] = $data['harga_modal'] + $data['up_harga'];
 			$row['operator'] = $data['operator'];
 			   
			array_push($jsonObj,$row);
		
        }
        
        $output=array( "code" => "200", "msg" => $jsonObj);
         echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }


    public function getHMAC()
    {
        $appkey = "d3ec83d12658d5764635291410bd5ca47dd7e64c83b1713cc6015facb4d4b8fc";
        $appid = "jajalin";
        $random = strtotime("now");
        $data = $appid.$random;
        $hmac = hash_hmac('sha256', $data, $appkey);

        $merchant_id = '1790527';
        $store_code = 'JAJALINPTP';
        $mid = '290527699712330';
        $tid = '16680';

        
        $output=array( "app_id" => $appid, "random" => $random,"hmac" => $hmac,"merchant_id" => $merchant_id,"store_code" => $store_code, "mid" => $mid,"tid" => $tid);
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));



    }


    public function getHMACStaging()
    {
        $appkey = "d3ec83d12658d5764635291410bd5ca47dd7e64c83b1713cc6015facb4d4b8fc";
        $appid = "jajalin";
        $random = strtotime("now");
        $data = $appid.$random;
        $hmac = hash_hmac('sha256', $data, $appkey);

        $merchant_id = '1790527';
        $store_code = 'JAJALINPTP';
        $mid = '290527699712330';
        $tid = '16680';

        
        $output=array( "app_id" => $appid, "random" => $random,"hmac" => $hmac,"merchant_id" => $merchant_id,"store_code" => $store_code, "mid" => $mid,"tid" => $tid);
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));



    }

    function sendJualBeliHana(Request $request)
    {
        $data['nama_depan'] = $request->nama_depan;
        $data['nama_belakang'] = $request->nama_belakang;
        $data['email'] = $request->email;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['nama_ibu_kandung'] = $request->nama_ibu_kandung;
        $data['merk'] = $request->merk;
        $data['tipe'] = $request->tipe;
        $data['tahun_kendaraan'] = $request->tahun_kendaraan;
        $data['warna_mobil'] = $request->warna_mobil;
        $data['nomor_rangka'] = $request->nomor_rangka;
        $data['nomor_mesin'] = $request->nomor_mesin;
        $data['harga_mobil'] = $request->harga_mobil;
        $data['tenor'] = $request->tenor;
        $data['uang_muka'] = $request->uang_muka;
        $data['no_hp'] = $request->no_hp;
        $data['no_wa'] = $request->no_wa;

        // $data = array(
        //     'name'      =>  $request->name,
        //     'email'   =>   $request->email,
        //     'phone'   =>   $request->phone,
        //     'address'   =>   $request->address
        // );


        $random_name = str_random(12);

        if(!empty($request->file('foto'))) {
            $foto = $request->nama_depan.'-'.$random_name.'1'.'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path("/hana/jual_beli"), $foto);
            $data['foto'] = $foto;  }

        if(!empty($request->file('foto_ktp'))) {
            $foto_ktp = $request->nama_depan.'-'.$random_name.'2'.'.'.$request->file('foto_ktp')->getClientOriginalExtension();
            $request->file('foto_ktp')->move(public_path("/hana/jual_beli"), $foto_ktp);
            $data['foto_ktp'] = $foto_ktp;  }

        if(!empty($request->file('foto_unit'))) {
            $foto_unit = $request->nama_depan.'-'.$random_name.'3'.'.'.$request->file('foto_unit')->getClientOriginalExtension();
            $request->file('foto_unit')->move(public_path("/hana/jual_beli"), $foto_unit);
            $data['foto_unit'] = $foto_unit;  }

        if(!empty($request->file('foto_stnk'))) {
            $foto_stnk = $request->nama_depan.'-'.$random_name.'4'.'.'.$request->file('foto_stnk')->getClientOriginalExtension();
            $request->file('foto_stnk')->move(public_path("/hana/jual_beli"), $foto_stnk);
            $data['foto_stnk'] = $foto_stnk;  }

        Jual_beli::insert($data);

        Mail::to('diansulistyadi92@gmail.com')->send(new SendMailJualBeli($data));
        $output=array( "code" => "200", "msg" => 'email terkirim');
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));

    }

    function sendRefinancingHana(Request $request)
    {
        $data['nama_depan'] = $request->nama_depan;
        $data['nama_belakang'] = $request->nama_belakang;
        $data['email'] = $request->email;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['nama_ibu_kandung'] = $request->nama_ibu_kandung;
        $data['merk'] = $request->merk;
        $data['tipe'] = $request->tipe;
        $data['tahun_kendaraan'] = $request->tahun_kendaraan;
        $data['warna_mobil'] = $request->warna_mobil;
        $data['nomor_rangka'] = $request->nomor_rangka;
        $data['nomor_mesin'] = $request->nomor_mesin;
        $data['harga_mobil'] = $request->harga_mobil;
        $data['tenor'] = $request->tenor;
        $data['uang_muka'] = $request->uang_muka;
        $data['no_hp'] = $request->no_hp;
        $data['no_wa'] = $request->no_wa;

        $random_name = str_random(12);

        if(!empty($request->file('foto'))) {
            $foto = $request->nama_depan.'-'.$random_name.'1'.'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path("/hana/refinancing"), $foto);
            $data['foto'] = $foto;  }

        if(!empty($request->file('foto_ktp'))) {
            $foto_ktp = $request->nama_depan.'-'.$random_name.'2'.'.'.$request->file('foto_ktp')->getClientOriginalExtension();
            $request->file('foto_ktp')->move(public_path("/hana/refinancing"), $foto_ktp);
            $data['foto_ktp'] = $foto_ktp;  }

        if(!empty($request->file('foto_unit'))) {
            $foto_unit = $request->nama_depan.'-'.$random_name.'3'.'.'.$request->file('foto_unit')->getClientOriginalExtension();
            $request->file('foto_unit')->move(public_path("/hana/refinancing"), $foto_unit);
            $data['foto_unit'] = $foto_unit;  }

        if(!empty($request->file('foto_stnk'))) {
            $foto_stnk = $request->nama_depan.'-'.$random_name.'4'.'.'.$request->file('foto_stnk')->getClientOriginalExtension();
            $request->file('foto_stnk')->move(public_path("/hana/refinancing"), $foto_stnk);
            $data['foto_stnk'] = $foto_stnk;  }


        if(!empty($request->file('foto_bpkb'))) {
            $foto_bpkb = $request->nama_depan.'-'.$random_name.'5'.'.'.$request->file('foto_bpkb')->getClientOriginalExtension();
            $request->file('foto_bpkb')->move(public_path("/hana/refinancing"), $foto_bpkb);
            $data['foto_bpkb'] = $foto_bpkb;  }

        Refinancing::insert($data);

        Mail::to('diansulistyadi92@gmail.com')->send(new SendMailRefinancing($data));
        $output=array( "code" => "200", "msg" => 'email terkirim');
        echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }

    function sendUmrohHana(Request $request)
    {
        $data['nama_depan'] = $request->nama_depan;
        $data['nama_belakang'] = $request->nama_belakang;
        $data['email'] = $request->email;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tanggal_lahir'] = $request->tanggal_lahir;
        $data['nama_ibu_kandung'] = $request->nama_ibu_kandung;
        $data['merk'] = $request->merk;
        $data['tipe'] = $request->tipe;
        $data['tahun_kendaraan'] = $request->tahun_kendaraan;
        $data['warna_mobil'] = $request->warna_mobil;
        $data['nomor_rangka'] = $request->nomor_rangka;
        $data['nomor_mesin'] = $request->nomor_mesin;
        $data['usia_kendaraan'] = $request->usia_kendaraan;
        $data['jenis_paket'] = $request->jenis_paket;
        $data['jumlah_paket'] = $request->jumlah_paket;
        $data['no_hp'] = $request->no_hp;
        $data['no_wa'] = $request->no_wa;

        $random_name = str_random(12);

        if(!empty($request->file('foto'))) {
            $foto = $request->nama_depan.'-'.$random_name.'1'.'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path("/hana/umroh"), $foto);
            $data['foto'] = $foto;  }

        if(!empty($request->file('foto_ktp'))) {
            $foto_ktp = $request->nama_depan.'-'.$random_name.'2'.'.'.$request->file('foto_ktp')->getClientOriginalExtension();
            $request->file('foto_ktp')->move(public_path("/hana/umroh"), $foto_ktp);
            $data['foto_ktp'] = $foto_ktp;  }

        if(!empty($request->file('foto_unit'))) {
            $foto_unit = $request->nama_depan.'-'.$random_name.'3'.'.'.$request->file('foto_unit')->getClientOriginalExtension();
            $request->file('foto_unit')->move(public_path("/hana/umroh"), $foto_unit);
            $data['foto_unit'] = $foto_unit;  }

        if(!empty($request->file('foto_stnk'))) {
            $foto_stnk = $request->nama_depan.'-'.$random_name.'4'.'.'.$request->file('foto_stnk')->getClientOriginalExtension();
            $request->file('foto_stnk')->move(public_path("/hana/umroh"), $foto_stnk);
            $data['foto_stnk'] = $foto_stnk;  }

            Umroh::insert($data);

            Mail::to('diansulistyadi92@gmail.com')->send(new SendMailUmroh($data));
            $output=array( "code" => "200", "msg" => 'email terkirim');
            echo(json_encode($output, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
    }



	// -------------------------------------------------------batas akhir------------------------------------------------------
}
