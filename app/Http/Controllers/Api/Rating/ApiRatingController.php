<?php

namespace App\Http\Controllers\Api\Rating;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;
use App\Http\Resources\Rating\RatingResource;
use Illuminate\Http\Response;

class ApiRatingController extends Controller
{
    public function index()
    {
        $Rating = Rating::get();

        return response()->json([  'data'=>$Rating ]);
    }

    public function store(Request $request)
    {
        $Rating = Rating::create($request->all());
        return response(new RatingResource($Rating), Response::HTTP_CREATED);
    }

    public function show ($id)
    {
        $Rating = Rating::Find($id);
        return response()->json(['data' => $Rating]);
    }
    
    public function update (Request $request,$id)
    {
        $Rating = Rating::Find($id);
        $Rating->update($request->all());
        return response(new RatingResource($Rating), Response::HTTP_CREATED);
    }

    public function destroy (Rating $Rating)
    {   
        $Rating->delete();
        return response('Deleted', Response::HTTP_OK);
    }
}
