<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Response;
use Faker\factory as Faker;
use File;
use Carbon\Carbon;

class ApiCustomerController extends Controller
{
    public function index()
    {
        $Customer = Customer::get();
        return response()->json([  'data'=>$Customer ]);
    }
	
	public function akun (Request $request)
    {
        $Customer = Customer::Find($request->id);
        return response()->json(['data' => $Customer]);
    }

    public function store(Request $request)
    {        
        $random_name = str_random(12);
        $current_time = Carbon::now('Asia/Jakarta');

        $data['first_name'] = $request->first_name;
        $data['negara'] = $request->negara;
        $data['occupation'] = $request->occupation;
        $data['last_name'] = $request->last_name;
        $data['gender'] = $request->gender;
        $data['birth_date'] = $request->birth_date;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['id'] = $request->id;
        $data['created_at'] = $current_time;

        if(!empty($request->file('photo_profile'))) {
            $photo_profile = $random_name.'.'.$request->file('photo_profile')->getClientOriginalExtension();
            $request->file('photo_profile')->move(public_path("/photo_profile"), $photo_profile);
            $data['photo_profile'] = $photo_profile;  }

        Customer::insert($data);

        return response()->json(
            $data
        );
    }

    public function show ($id)
    {
        $Customer = Customer::Find($id);
        return response()->json(['data' => $Customer]);
    }
    
    public function update (Request $request,$id)
    {
        $Customer = Customer::Find($id);
        $Customer->update($request->all());
        return response(new CustomerResource($Customer), Response::HTTP_CREATED);
    }

    public function destroy (Customer $Customer)
    {   
        $Customer->delete();
        return response('Deleted', Response::HTTP_OK);
    }

    public function ngecek(Request $request)
    {   
        $Customer = Customer::where('phone','=',$request->phone)->first();
        
        if ($Customer === null) {

            return  response()->json([
                'message' => 'akun ini tidak terdaftar',
                'code' => '0',    
            ], 200);
        } else {
            
           return  response()->json([
                'message' => 'akun ini telah terdaftar',
                'code' => '1',    
            ], 200);
        }       

        
    }


}
