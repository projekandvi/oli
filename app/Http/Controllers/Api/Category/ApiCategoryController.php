<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Response;

class ApiCategoryController extends Controller
{
    public function index()
    {
        $Category = Category::get();

        return response()->json([  'data'=>$Category ]);
    }

    public function store(Request $request)
    {
        $Category = Category::create($request->all());
        return response(new CategoryResource($Category), Response::HTTP_CREATED);
    }

    public function show ($id)
    {
        $Category = Category::Find($id);
        return response()->json(['data' => $Category]);
    }
    
    public function update (Request $request,$id)
    {
        $Category = Category::Find($id);
        $Category->update($request->all());
        return response(new CategoryResource($Category), Response::HTTP_CREATED);
    }

    public function destroy (Category $Category)
    {   
        $Category->delete();
        return response('Deleted', Response::HTTP_OK);
    }
}
