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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', function () {
        return view('index', [
            "title" => "Index",
            'active' => "Index"
        ]);
    });

    Route::get('/BHP/dashboard', [DashboardController::class, 'show']);
    // aktiviatas pemasukan
    Route::get('/BHP/laporanpemasukan', [BHPPemasukanController::class, 'laporan']);
    Route::get('/BHP/laporanpemasukan/cetak', [BHPPemasukanController::class, 'cetaklaporan']);
    Route::get('/BHP/laporanpemasukan/search', [BHPPemasukanController::class, 'search']);
    Route::resource('/BHP/aktivitaspemasukan', BHPPemasukanController::class);

    // aktivitas pengeluaran
    Route::get('/BHP/aktivitaspengeluaran/barcode', [BHPPengeluaranController::class, 'autofill']);
    Route::get('/BHP/aktivitaspengeluaran/read', [BHPPengeluaranController::class, 'read']);
    Route::get('/BHP/laporanpengeluaran', [BHPPengeluaranController::class, 'laporan']);
    Route::get('/BHP/laporanpengeluaran/cetak', [BHPPengeluaranController::class, 'cetaklaporan']);
    Route::resource('/BHP/aktivitaspengeluaran', BHPPengeluaranController::class);

    Route::get('/search/mahasiswa', [AktivitasController::class, 'searchMahasiswa'])->name('aktivitas.search.mahasiswa');
    Route::get('/search/alat', [AktivitasController::class, 'searchAlat'])->name('aktivitas.search.alat');

    Route::get('/BHP/stok', [StokController::class, 'index']);
    Route::get('/BHP/stok/cetak', [StokController::class, 'cetak_pdf']);

    Route::resource('/BHP/akun', AccountController::class);

    /////////////PERALATAN//////////////////
    Route::get('/alat/dashboard', function () {
        return view('alat.dashboard', [
            "title" => "Dashboard",
            'active' => "dashboard"
        ]);
    });
    Route::get('/alat/peminjaman', function () {
        return view('alat.peminjaman', [
            "title" => "Peminjaman"
        ]);
    });

    Route::get('/alat/pengembalian', function () {
        return view('alat.pengembalian', [
            "title" => "Pengembalian"
        ]);
    });

    Route::get('/alat/laporanpeminjaman', function () {
        return view('alat.laporanpeminjaman', [
            "title" => "LaporanPeminjaman"
        ]);
    });

    Route::get('/alat/datamahasiswa', [MahasiswaController::class, 'datamahasiswa']);
    Route::get('/alat/dataperalatan', [PeralatanController::class, 'dataperalatan']);
});


// hak akses untuk admin
Route::group(['middleware' => ['admin', 'auth']], function(){
    Route::resource('/BHP/material', MaterialController::class);
    Route::resource('/BHP/materials', CetakBarcodeController::class);
    Route::resource('/BHP/material/unit', UnitController::class);
    Route::resource('/BHP/user', UsersController::class);
    Route::resource('/BHP/dataBHP', BHPController::class);

    Route::resource('/alat/pendataanmahasiswa', MahasiswaController::class);
    Route::resource('/alat/pendataanperalatan', PeralatanController::class);
    Route::resource('/alat/pendataanjenis', JenisController::class);
    Route::resource('/alat/pendataanlokasi', LokasiController::class);
    Route::resource('/alat/peminjamandanpengembalian', AktivitasController::class);
});
