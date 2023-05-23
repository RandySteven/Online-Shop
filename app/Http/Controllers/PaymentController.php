<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index($id){
        $index = $id - 1;
        $paymentQrisPaths = [
            'qrisPath',
            'gopayPath',
            'ovoPath'
        ];

        $paymentPath = $paymentQrisPaths[$index];

        return view('payments.index', compact('paymentPath'));
    }

}
