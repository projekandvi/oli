<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FrontEndController extends Controller
{
    public function user_menu(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.userMenu',compact('dataUser'));
    }
}
