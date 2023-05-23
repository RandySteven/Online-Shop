<?php

namespace App\Http\Controllers;

use App\Mail\TransactionShipped;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public static function randchar($length){
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $clen = strlen($chars) - 1;
        $id = '';
        for($i=0 ; $i < $length ; $i++){
            $id .= $chars[mt_rand(0, $clen)];
        }
        return ($id);
    }

    public function store(Request $request){
        $carts = Cart::where('user_id', auth()->user()->id);
        $cartUsers = $carts->get();
        $attr = $request->all();
        $attr['courier_id'] = $request->get('courier_id');
        $attr['payment_id'] = $request->get('payment_id');
        $attr['invoice'] = strtoupper('TR'.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9).$this->randchar(3));
        $transaction = auth()->user()->transactions()->create($attr);

        foreach($cartUsers as $cart){
            $transaction->details()->create([
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity
            ]);
            $product = Product::where('id', $cart->product->id);
            $product->decrement('stock', $cart->quantity);
        }
        $carts->delete();
        // Mail::to(Auth::user()->email)->send(new TransactionShipped($cartUsers, $transaction));
        return redirect()->route('payment.index', [$attr['payment_id']]);
    }

    public function history(){
        $transactions = Transaction::where('user_id', auth()->user()->id)->get();
        return view('transaction.history', compact('transactions'));
    }

    public function historyDetail(Transaction $transaction){
        $details = $transaction->details()->get();
        return view('transaction.history-detail', compact('details', 'transaction'));
    }

    public function shopTransaction(){
        $query = "SELECT * FROM transactions JOIN transaction_details ON transactions.id=transaction_details.transaction_id JOIN products ON transactions_details.product_id=products.id JOIN
        users ON users.id=product.shop_id WHERE products.shop_id=".Auth::user()->id." GROUP BY transactions.id ";
        $transactions = Transaction::query($query)->get();
        return view('shop.transaction', compact('transactions'));
    }

    public function shopTransactionDetail(Transaction $transaction){
        $product_id = 0;
        $products = Product::where('shop_id', Auth::user()->id);
        foreach($products as $product){
            $product_id = $product->id;
        }
        $query = "SELECT * FROM transactions JOIN transaction_details ON transactions.id=transaction_details.transaction_id JOIN products ON transactions_details.product_id=products.id JOIN
        users ON users.id=product.shop_id WHERE products.shop_id=".Auth::user()->id."";
        $details = TransactionDetail::query($query)->where('transaction_id', $transaction->id)->get();
        return view('shop.transaction-detail', compact('details', 'transaction'));
    }

    public function delete(Transaction $transaction){
        $transaction->delete($transaction);
        return back()->with('success', 'Delete history success');
    }
}
