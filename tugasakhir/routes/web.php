<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OpentripController;
use App\Http\Controllers\Alatoutdoorcontroller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\OpenTripViewController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::controller(HomeController::class)->group(function(){
    Route::get('home', 'index');
    Route::post('home', 'store')->name('home.store');
});

Route::get('/account', [AccountController::class, 'index'])->middleware('auth');
Route::get('/profil', [ProfileController::class, 'index']);

Route::controller(OpenTripViewController::class)->group(function(){
    Route::get('opentripview', 'index');
    Route::post('get_opentrip', 'get_opentrip')->name('opentripview.get_opentrip');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('profile', 'index');
    Route::post('user_comment', 'user_comment')->name('profile.user_comment');
});

Route::controller(KeranjangController::class)->group(function(){
    Route::get('keranjang', 'index');
    Route::post('keranjang', 'upload_payment')->name('keranjang.upload_payment');
    Route::post('keranjang/delete_item', 'delete_item')->name('keranjang.delete_item');
});

Route::controller(PenyewaanController::class)->group(function(){
    Route::get('penyewaan', 'index');
    Route::get('sewa', 'sewa');
    Route::post('get_alatoutdoor', 'get_alatoutdoor')->name('penyewaan.get_alatoutdoor');
    Route::post('list_item', 'list_item')->name('penyewaan.list_item');
    Route::post('ambil_item', 'ambil_item')->name('penyewaan.ambil_item');
    Route::post('confirm_payment', 'confirm_payment')->name('penyewaan.confirm_payment');
});

Route::controller(PengembalianController::class)->group(function(){
    Route::get('pengembalian', 'index');
    Route::post('list_item_kembali', 'list_item')->name('pengembalian.list_item_kembali');
    Route::post('kembalikan_item', 'kembalikan_item')->name('pengembalian.kembalikan_item');
});

Route::resource('/alatoutdoor', Alatoutdoorcontroller::class);
Route::resource('/opentrip', OpentripController::class);
Route::resource('/kategori', KategoriController::class);
Route::resource('/datauser', UserController::class);

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/logtransaksi', function () {
    return view('dashboard.logtransaksi.index', [
        "title" => "transaksi"
    ]);
});

