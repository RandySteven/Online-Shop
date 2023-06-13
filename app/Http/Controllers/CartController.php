<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Courier;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $carts = Cart::all();
        $user = new User();
        $couriers = Courier::get();
        $payments = Payment::get();
        return view('cart.index', compact('carts', 'user', 'couriers', 'payments'));
    }

    public function store(Request $request){
        $attr = $request->all();
        $duplicate = Cart::where('product_id', $request->product_id)->first();
        if($duplicate){
            return back()->with('error', 'Item sudah ada');
        }
        if($attr['quantity']<1){
            return back()->with('error', 'Quantity item harus lebih dari 1');
        }
        $attr['product_id'] = $request->get('product_id');
        // $attr['user_id'] = $request->get('user_id');
        auth()->user()->carts()->create($attr);
        return redirect('carts/your-carts')->with('success', 'Add to cart success');
    }

    public function delete(Cart $cart){
        Cart::where('product_id', $cart->product_id)->delete();
        return back();
    }
}
