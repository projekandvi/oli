<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Response;

class ApiUserController extends Controller
{
    public function index()
    {
        $User = User::get();

        return response()->json([  'data'=>$User ]);
    }

    public function store(Request $request)
    {
        $User = User::create($request->all());
        return response(new UserResource($User), Response::HTTP_CREATED);
    }

    public function show ($id)
    {
        $User = User::Find($id);
        return response()->json(['data' => $User]);
    }
    
    public function update (Request $request,$id)
    {
        $User = User::Find($id);
        $User->update($request->all());
        return response(new UserResource($User), Response::HTTP_CREATED);
    }

    public function destroy (User $User)
    {   
        $User->delete();
        return response('Deleted', Response::HTTP_OK);
    }
}
