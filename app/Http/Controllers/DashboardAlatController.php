<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use App\Models\Peralatan;

class DashboardAlatCnntroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $aktivitas = Aktivitas::get();
        $mahasiswas = Mahasiswa::get();
        $peralatans = Peralatan::get();
        // $datas = Aktivitas::where('status', 'pinjam')->get();
        return view('alat.dashboard', compact('mahasiswas', 'peralatans'));
    }
}