<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index(Transaction $transaction){
        $invoice = $transaction->invoice;
        $index = $transaction->payment_id - 1;
        $paymentQrisPaths = [
            'bcaPath',
            'qrisPath',
        ];

        $paymentPath = $paymentQrisPaths[$index];

        return view('payments.index', compact('paymentPath', 'invoice', 'transaction'));
    }

    public function getInvoice(Transaction $transaction){
        $invoice = $transaction->invoice;
        return view('payments.invoice', compact('transaction', 'invoice'));
    }

}
