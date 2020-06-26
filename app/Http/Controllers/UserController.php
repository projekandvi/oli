<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\CustomerRequest;

class UserController extends Controller
{
    private $searchParams = ['name'];
    public function getIndex(Request $request)
    {
        
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

    public function postUser(UserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');

        $user->save();

        $message = 'changes saved';
        return redirect()->route('user.index')->withMessage($message);

    }


    public function getEditUser(User $user)
    {   
        return view('user.form')->withUser($user);
    }

    public function getUserDetails(User $user)
    {   
        return view('user.details')->withBarang($user);
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $message = 'Deleted';
        return redirect()->back()->withMessage($message);
    }
}
