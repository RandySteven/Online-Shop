<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function product(Request $request){
        $products = Product::where('name', 'LIKE', '%'. $request->name .'%')->latest()->paginate(9);
        // $output = "";
        // if($request->ajax()){
        //     foreach($products as $product){
        //         $output = '<tr>'.
        //         '<td>'.$product->id.'</td>'.
        //         '<td>'.$product->name.'</td>'.
        //         '</tr>';
        //     }
        // }
        return view('product.index', compact('products'));
    }
}
