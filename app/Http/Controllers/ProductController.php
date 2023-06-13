<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all()->sortBy('name');
        return view('product.index', compact('products'));
    }

    public function create(){
        $categories = Category::get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:8|max:50',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'desc' => 'required|max:5000'
        ]);
        $attr = $request->all();
        $attr['slug'] = \Str::slug($request->name);
        $attr['thumbnail'] = $request->file('thumbnail')->store("images/product");
        $attr['category_id'] = $request->get('category_id');
        $attr['shop_id'] = auth()->user()->id;
        Product::create($attr);
        return redirect('products')->with('success', 'Success add product');
    }

    public function show(Product $product){
        $products = Product::get();
        if($products->count()>0&&$products->count()>3){
            $products = $products->sortBy('id', 3)->take($products->count())->random(3);
        }
        return view('product.show', compact('product', 'products'));
    }

    public function edit(Product $product){
        $categories = Category::get();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required|min:8|max:50',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'desc' => 'required|max:5000'
        ]);
        $attr = $request->all();
        $attr['slug'] = \Str::slug($request->name);
        if($request->file('thumbnail')){
            Storage::delete('images/product/'.$product->thumbnail);
            $thumbnail = $request->file('thumbnail')->store("images/product");
        }else{
            $thumbnail = $product->thumbnail;
        }
        $attr['thumbnail'] = $thumbnail;
        $attr['category_id'] = $request->get('category_id') != null ? $request->get('category_id') : $product->category->id;
        $attr['shop_id'] = auth()->user()->id;
        $product->update($attr);
        return redirect('products')->with('success', 'Success edit product');
    }

    public function delete(Product $product){
        $product->delete($product);
        return redirect('products')->with('success', 'Success delete product');
    }
}
