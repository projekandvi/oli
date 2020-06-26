<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function store(Request $request) {
        // $this->validate($request, [
        //     'first_name'    => 'required',
        //     'last_name'    => 'required',
        //     'phone'    => 'required',
        //     'email'   => 'required|email',
        //     'message' => 'required',
        //     'g-recaptcha-response' => 'required|captcha',
        // ]);

        User::create([
            'child_fullname'      => $request->input('child_fullname'),
            'child_username'      => $request->input('child_username'),
            'child_gender'      => $request->input('child_gender'),
            'educational_stage'      => $request->input('educational_stage'),
            'child_birthday'     => $request->input('child_birthday'),
            'parent_fullname'   => $request->input('parent_fullname'),
            'parent_gender'   => $request->input('parent_gender'),
            'password'   => Hash::make($request->input('password')),
            'parent_email'   => $request->input('parent_email'),
            'email'   => $request->input('parent_email'),
            'parent_phone'   => $request->input('parent_phone'),
            'address'   => $request->input('address'),
            'country'   => $request->input('country'),
            'province'   => $request->input('province'),
            'city'   => $request->input('city'),
            'district'   => $request->input('district'),
            'sub_district'   => $request->input('sub_district'),
            'postal_code'   => $request->input('postal_code'),
        ]);
        // return  response()->json([
        //     'message' => 'akun terdaftar',   
        // ], 200);
        return redirect('/'); 
    }
}
