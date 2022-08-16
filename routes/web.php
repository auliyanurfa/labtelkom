<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BHPController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CetakBarcodeController;
use App\Http\Controllers\BHPPemasukanController;
use App\Http\Controllers\BHPPengeluaranController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\AktivitasController;

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
    return view('index', [
        "title" => "Index",
        'active' => "Index"
    ]);
})->middleware('auth');

Route::get('/BHP/dashboard', [DashboardController::class, 'show'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// aktiviatas pemasukan
Route::get('/BHP/laporanpemasukan', [BHPPemasukanController::class, 'laporan'])->middleware('auth');
Route::get('/BHP/laporanpemasukan/cetak', [BHPPemasukanController::class, 'cetaklaporan'])->middleware('auth');
Route::get('/BHP/laporanpemasukan/search', [BHPPemasukanController::class, 'search'])->middleware('auth');
Route::resource('/BHP/aktivitaspemasukan', BHPPemasukanController::class)->middleware('auth');

// aktivitas pengeluaran
Route::get('/BHP/aktivitaspengeluaran/barcode', [BHPPengeluaranController::class, 'autofill'])->middleware('auth');
Route::get('/BHP/aktivitaspengeluaran/read', [BHPPengeluaranController::class, 'read'])->middleware('auth');
Route::get('/BHP/laporanpengeluaran', [BHPPengeluaranController::class, 'laporan'])->middleware('auth');
Route::get('/BHP/laporanpengeluaran/cetak', [BHPPengeluaranController::class, 'cetaklaporan'])->middleware('auth');
Route::resource('/BHP/aktivitaspengeluaran', BHPPengeluaranController::class)->middleware('auth');


Route::get('/BHP/stok', [StokController::class, 'index'])->middleware('auth');
Route::get('/BHP/stok/cetak', [StokController::class, 'cetak_pdf'])->middleware('auth');

Route::resource('/BHP/akun', AccountController::class)->middleware('auth');

// hak akses untuk admin
Route::group(['middleware' => 'admin'], function(){
    Route::resource('/BHP/material', MaterialController::class)->middleware('auth');
    Route::resource('/BHP/materials', CetakBarcodeController::class)->middleware('auth');
    Route::resource('/BHP/material/unit', UnitController::class)->middleware('auth');
    Route::resource('/BHP/user', UsersController::class)->middleware('auth');
    Route::resource('/BHP/dataBHP', BHPController::class)->middleware('auth');
});




/////////////PERALATAN//////////////////
Route::get('/alat/dashboard', function () {
    return view('alat.dashboard', [
        "title" => "Dashboard",
        'active' => "dashboard"
    ]);
})->middleware('auth');
Route::get('/alat/peminjaman', function () {
    return view('alat.peminjaman', [
        "title" => "Peminjaman"
    ]);
})->middleware('auth');

Route::get('/alat/pengembalian', function () {
    return view('alat.pengembalian', [
        "title" => "Pengembalian"
    ]);
})->middleware('auth');

Route::get('/alat/laporanpeminjaman', function () {
    return view('alat.laporanpeminjaman', [
        "title" => "LaporanPeminjaman"
    ]);
})->middleware('auth');

Route::get('/alat/datamahasiswa', [MahasiswaController::class, 'datamahasiswa'])->middleware('auth');
Route::get('/alat/dataperalatan', [PeralatanController::class, 'dataperalatan'])->middleware('auth');


Route::group(['middleware' => 'admin'], function(){
    Route::resource('/alat/pendataanmahasiswa', MahasiswaController::class)->middleware('auth');
    Route::resource('/alat/pendataanperalatan', PeralatanController::class)->middleware('auth');;
    Route::resource('/alat/pendataanjenis', JenisController::class)->middleware('auth');
    Route::resource('/alat/pendataanlokasi', LokasiController::class)->middleware('auth');
    Route::resource('/alat/peminjamandanpengembalian', AktivitasController::class)->middleware('auth');
});