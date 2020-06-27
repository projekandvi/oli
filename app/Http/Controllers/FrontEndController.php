<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use File;

class FrontEndController extends Controller
{
    public function user_menu(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.my_profile',compact('dataUser'));
    }

    public function myProfileEdit(User $dataUser){   
        return view('personalData.my_profile_edit')->withDataUser($dataUser);  
    }
    public function simpanMyProfileEdit(Request $request){ 
        // dd($request->hasFile('photo_profile'));
        $dataUser = User::where('id','=',Auth::user()->id)->first();   

        if($request->hasFile('photo_profile')){
            if ($dataUser->photo_profile != null) {
                File::delete(public_path('uploads/photo_profile/' . $dataUser->photo_profile));
            }            
            $file = $request->file('photo_profile');
            $file_extension = $file->getClientOriginalExtension();
            $random_name = str_random(12);
            $destination_path = public_path().'/uploads/photo_profile/';
            $filename = 'photo_profile-'.$dataUser->id.'.'.$file_extension;            
            $request->file('photo_profile')->move($destination_path,$filename);
        }

        User::where('id',$request->input('id'))->update([
            'child_fullname'      => $request->input('child_fullname'),
            'child_username'      => $request->input('child_username'),
            'bio'      => $request->input('bio'),
            'hobby'      => $request->input('hobby'),
            'child_gender'      => $request->input('child_gender'),
            'educational_stage'      => $request->input('educational_stage'),
            'child_birthday'     => $request->input('child_birthday'),
            'parent_fullname'   => $request->input('parent_fullname'),
            'parent_gender'   => $request->input('parent_gender'),
            'parent_email'   => $request->input('parent_email'),
            'parent_phone'   => $request->input('parent_phone'),
            'parent_phone'   => $request->input('parent_phone'),
            'address'   => $request->input('address'),
            'country'   => $request->input('country'),
            'province'   => $request->input('province'),
            'city'   => $request->input('city'),
            'district'   => $request->input('district'),
            'sub_district'   => $request->input('sub_district'),
            'postal_code'   => $request->input('postal_code'),
            'photo_profile'   => $filename,
        ]);
        return redirect()->back();
    }
    
}
