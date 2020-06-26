<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function getIndex()
    {   
        $products = Product::all();
        $clients = Client::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $warehouses = Warehouse::all();
        return view('reporting.index', 
               compact(
                    'products', 
                    'clients', 
                    'categories', 
                    'subcategories', 
                    'warehouses'
                    )
                );       
    }
}
