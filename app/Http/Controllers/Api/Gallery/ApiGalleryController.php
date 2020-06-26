<?php

namespace App\Http\Controllers\Api\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use App\Http\Resources\Gallery\GalleryResource;
use Illuminate\Http\Response;
use Faker\factory as Faker;
use File;

class ApiGalleryController extends Controller
{
    public function index ()
    {
       $Gallery = Gallery::get();

        return response()->json([
            'data' =>$Gallery
        ]);
    }

    public function store(Request $request)
    {
        $faker = Faker::create();

        $data['destination_id'] = $request->destination_id;
        $data['file_type'] = $request->file_type;

        if(!empty($request->file('name'))) {
            $name = $faker->ean8.'.'.$request->file('name')->getClientOriginalExtension();
            $request->file('name')->move(public_path("/gallery"), $name);
            $data['name'] = $name;  }

        Gallery::insert($data);

        return response(new GalleryResource($data), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $Gallery = Gallery::Find($id);
        return response()->json(['data' => $Gallery]);
    }

    public function update(Request $request, $id)
    {
        $faker = Faker::create();

        $Gallery = Gallery::FindOrFail($id);  
        
        $name = $Gallery->name; 
        $Gallery->destination_id = $request->destination_id;
        $Gallery->name = $request->name;
        
         
        if(!empty($request->file('name')))
        {
            File::delete(public_path('/gallery/' . $name));
            $name = $faker->ean8.'.'.$request->file('name')->getClientOriginalExtension();
            $request->file('name')->move(public_path("/gallery"), $name);
            $Gallery->name = $name;    
        }

        $Gallery->save();
        return response(new GalleryResource($Gallery), Response::HTTP_CREATED);    
    }
    public function edit($id)
    {
        $editGallery = Gallery::find($id);
        return view ('Gallery.edit1', compact('editGallery'));
    }

    public function destroy(Gallery $Gallery)
    {
        $Gallery->delete();
        return response ('deleted', Response::HTTP_OK);
    }
}
