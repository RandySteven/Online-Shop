<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Models\Chart;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products = DB::table('products as p')
    ->join('transaction_details as td', 'p.id', '=', 'td.product_id')
    ->join('categories as c', 'p.category_id', '=', 'c.id')
    ->select('p.name', 'p.category_id', 'p.stock', 'c.category', 'c.slug', 'p.slug', 'p.thumbnail', 'p.desc', DB::raw('COUNT(td.product_id) AS total_sales'))
    ->groupBy('p.name', 'p.category_id', 'p.stock', 'c.category', 'c.slug', 'p.slug', 'p.thumbnail', 'p.desc')
    ->orderBy('total_sales', 'DESC')
    ->limit(3)
    ->get();

    return view('welcome', compact('products'));
});

Route::get('/all-produts-and-categories', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/register-shop', function(){
    return view('auth.add-shop');
})->middleware(['auth'])->name('register.shop');

Route::get('/register-karyawan', function(){
    return view('auth.register-karyawan');
})->name('register.karyawan');

Route::post('/store-shop', [ShopController::class, 'store'])->name('store.shop');
Route::get('/shops', [ShopController::class, 'index'])->name('shop.index');
Route::middleware('auth')->group(function(){

    Route::prefix('products')->group(function(){
        Route::get('', [ProductController::class, 'index'])->name('product.index')->withoutMiddleware('auth');
        Route::get('/create-product', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{product:slug}', [ProductController::class, 'show'])->name('product.show')->withoutMiddleware('auth');
        Route::get('/product-edit/{product:slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/product-update/{product:slug}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product-delete/{product:slug}', [ProductController::class, 'delete'])->name('product.delete');
    });

    Route::prefix('carts')->group(function(){
        Route::get('/your-carts/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add-to-cart/', [CartController::class, 'store'])->name('cart.store');
        Route::delete('/delete-product-from-cart/{cart:product_id}', [CartController::class, 'delete'])->name('cart.delete');
    });

    Route::post('/transactions/', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/history-transactions/', [TransactionController::class, 'history'])->name('transaction.history');
    Route::get('/transaction-detail/{transaction:invoice}', [TransactionController::class, 'historyDetail'])->name('detail.history');
    Route::get('/shop-transaction', [TransactionController::class, 'shopTransaction'])->name('shop.transaction');
    Route::get('/{transaction:invoice}/data-transactions', [TransactionController::class, 'shopTransactionDetail'])->name('shop.detail.transaction');
    Route::delete('/delete-transaction-data/{transaction}', [TransactionController::class, 'delete'])->name('transaction.delete');

    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/reply', [CommentController::class, 'replies'])->name('comment.reply');

    Route::get('/payment/{transaction:id}', [PaymentController::class, 'index'])->name('payment.index');
});

Route::prefix('shop')->group(function(){
    Route::get('', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/{user:name}', [ShopController::class, 'show'])->name('shop.show');
});

Route::get('search/', [SearchController::class, 'product'])->name('search.product');

Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('category');
Route::get('/invoice/{transaction:id}', [PaymentController::class, 'getInvoice'])->name('getInvoice');

Route::middleware(['auth'])->group(function(){
    Route::get('admin-dashboard', function(){
        $transactions = DB::table('transactions')
            ->select(DB::raw('COUNT(*) as transaction_count'),
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as transaction_month"))
            ->groupBy('transaction_month')
            ->pluck('transaction_count', 'transaction_month');
        $chart = new Chart();
        $chart->labels = $transactions->keys();
        $chart->dataset = $transactions->values();
        for ($i=0; $i<=count($transactions); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $chart->colours = $colours;
        return view('admin-dashboard', compact('chart'));
    })->name('admin.dashboard');

    Route::get('admin-dashboard/filter/', function(Request $request){
        $year = $request->years;
        $month = $request->months;
        $transaction_month = $year.'-'.$month;
        $transactions = DB::table('transactions')
            ->select(DB::raw('COUNT(*) as transaction_count'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as transaction_month"))
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '$transaction_month'")
            ->groupBy('transaction_month')
            ->pluck('transaction_count', 'transaction_month');
        $chart = new Chart();
        $chart->labels = $transactions->keys();
        $chart->dataset = $transactions->values();
        for ($i=0; $i<=count($transactions); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }
        $chart->colours = $colours;
        return view('admin-dashboard', compact('chart'));
    })->name('admin.dashboard.filter');
});

Route::patch('/lunas/{transaction:id}', [TransactionController::class, 'updateLunas'])->name('update.lunas');

require __DIR__.'/auth.php';
