<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\FormalSchool;
use App\InformalSchool;
use Auth;
use File;
use Illuminate\Support\Facades\Hash;

class FrontEndController extends Controller
{
    public function user_menu(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.my_profile',compact('dataUser'));
    }
    
    public function educational_menu(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('educational.educational_menu',compact('dataUser'));
    }
    public function task(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.task',compact('dataUser'));
    }
    public function report(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.report',compact('dataUser'));
    }
    public function setting(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.setting',compact('dataUser'));
    }
    public function security(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.security',compact('dataUser'));
    }
    public function payment(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.payment',compact('dataUser'));
    }
    public function payment_method(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.payment_method',compact('dataUser'));
    }
    public function credit_card(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.credit_card',compact('dataUser'));
    }
    public function debit_card(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.debit_card',compact('dataUser'));
    }
    public function chat(){
        $dataUser = User::where('id','=',Auth::user()->id)->first();   
        return view('personalData.chat',compact('dataUser'));
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
        } else{
            $filename = $dataUser->photo_profile;
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
        return redirect('myProfile');
    }

    public function educationalFormal(){
        $dataEducationalFormal = FormalSchool::where('id_user','=',Auth::user()->id)->first();   
        return view('educational.educational_formal',compact('dataEducationalFormal'));
    }

    public function simpanEducationalFormal(Request $request){ 
        
        FormalSchool::create([
            'name'      => $request->input('name'),
            'class'      => $request->input('class'),
            'school_address'      => $request->input('school_address'),
            'province'      => $request->input('province'),
            'city'      => $request->input('city'),
            'extracurricular'      => $request->input('extracurricular'),
            'id_user'      => $request->input('id_user'),
        ]);
        return redirect('educational_formal');
    }

    public function edit_educational_formal(FormalSchool $dataEducationFormal){   
        return view('educational.edit_educational_formal')->withDataEducationFormal($dataEducationFormal);  
    }

    public function simpanEducationalFormalEdit(Request $request){ 
        
        FormalSchool::where('id',$request->input('id'))->update([
            'name' => $request->input('name'),
            'class' => $request->input('class'),
            'school_address' => $request->input('school_address'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'extracurricular' => $request->input('extracurricular'),
        ]);
        return redirect('educational_formal');
    }

    public function educationalInformal(){
        $dataEducationalInformal = InformalSchool::where('id_user','=',Auth::user()->id)->first();   
        return view('educational.educational_informal',compact('dataEducationalInformal'));
    }

    public function simpanEducationalInformal(Request $request){ 
        
        InformalSchool::create([
            'name'      => $request->input('name'),
            'type'      => $request->input('type'),
            'subject'      => $request->input('subject'),
            'school_address'      => $request->input('school_address'),
            'province'      => $request->input('province'),
            'city'      => $request->input('city'),
            'id_user'      => $request->input('id_user'),
        ]);
        return redirect('educational_informal');
    }

    public function edit_educational_informal(InformalSchool $dataEducationInformal){   
        return view('educational.edit_educational_informal')->withDataEducationInformal($dataEducationInformal);  
    }

    public function simpanEducationalInformalEdit(Request $request){ 
        
        InformalSchool::where('id',$request->input('id'))->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'subject' => $request->input('subject'),
            'school_address' => $request->input('school_address'),
            'province' => $request->input('province'),
            'city' => $request->input('city')            
        ]);
        return redirect('educational_informal');
    }

    public function changePassword(Request $request){
 
        if (Hash::check($request->current_password, Auth::user()->password)) {
            // The passwords matches
            if(strcmp($request->current_password, $request->new_password) == 0){
                //Current password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
                }
            if(!(strcmp($request->new_password, $request->confirm_password)) == 0){
                //New password and confirm password are not same
                return redirect()->back()->with("error","New Password should be same as your confirmed password. Please retype new password.");
            }
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();
             
            return redirect()->back()->with("success","Password changed successfully !");

        } else {
            return redirect()->back();
        }
         
    }
    
    
}
