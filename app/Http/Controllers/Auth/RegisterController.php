<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),            
            'child_fullname' => $data['child_fullname'],
            'child_username' => $data['child_username'],
            'educational_stage' => $data['educational_stage'],
            'child_gender' => $data['child_gender'],
            'child_birthday' => $data['child_birthday'],
            'parent_fullname' => $data['parent_fullname'],
            'parent_gender' => $data['parent_gender'],
            'parent_email' => $data['parent_email'],
            'parent_phone' => $data['parent_phone'],
            'address' => $data['address'],
            'country' => $data['country'],
            'province' => $data['province'],
            'city' => $data['city'],
            'district' => $data['district'],
            'sub_district' => $data['sub_district'],
            'postal_code' => $data['postal_code'],
        ]);

    }
}
