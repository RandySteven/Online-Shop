<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products = Product::paginate(9)->sortBy('name');
        return view('dashboard', compact('categories', 'products'));
    }
}
