<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function store(Request $request){
        $user = Auth::user();
        $image = $request->file('image')->store("images/shop");
        User::where('id', $user->id)->update([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'image' => $image
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    public function show(User $user){
        $products = Product::get();
        return view('shop.show', ['user'=>$user, 'products'=>$products]);
    }

    public function index(){
        $roleName = 'shop';
        $shops = User::whereHas('roles', function($q) use ($roleName){
            $q->where('name', $roleName);
        })->get();
        return view('shop.index', compact('shops'));
    }
}
