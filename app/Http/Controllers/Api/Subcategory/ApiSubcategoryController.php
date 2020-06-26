<?php

namespace App\Http\Controllers\Api\Subcategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcategory;
use App\Http\Resources\Subcategory\SubcategoryResource;
use Illuminate\Http\Response;

class ApiSubcategoryController extends Controller
{
    public function index()
    {
        $Subcategory = Subcategory::get();

        return response()->json([  'data'=>$Subcategory ]);
    }

    public function store(Request $request)
    {
        $Subcategory = Subcategory::create($request->all());
        return response(new SubcategoryResource($Subcategory), Response::HTTP_CREATED);
    }

    public function show ($id)
    {
        $Subcategory = Subcategory::Find($id);
        return response()->json(['data' => $Subcategory]);
    }
    
    public function update (Request $request,$id)
    {
        $Subcategory = Subcategory::Find($id);
        $Subcategory->update($request->all());
        return response(new SubcategoryResource($Subcategory), Response::HTTP_CREATED);
    }

    public function destroy (Subcategory $Subcategory)
    {   
        $Subcategory->delete();
        return response('Deleted', Response::HTTP_OK);
    }
}
