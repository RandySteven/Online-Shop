<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function product(Request $request){
        $products = Product::where('name', 'LIKE', '%'. $request->name .'%')->latest()->paginate(9);
        return view('product.index', compact('products'));
    }
}
