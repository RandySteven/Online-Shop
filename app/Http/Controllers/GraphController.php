<?php

use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller{

    public function index(){
        $transactions = Transaction::get();
        $chart = new Chart;
        for ($i=0; $i<=count($transactions); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $chart->labels = array_keys($transactions);
        $chart->dataset = array_values($transactions);
        $chart->colours = $colours;

        return view('admin-dashboard', compact('chart'));
    }

}
