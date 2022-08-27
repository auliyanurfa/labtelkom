<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use App\Models\Peralatan;
use Carbon\Carbon;

class DashboardAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function show(Peralatan $peralatans)
    {

        $title = "Dashboard";
        $active = "dashboard";
        $peralatans = Peralatan::count('id');
        $mahasiswas = Mahasiswa::count('id');
        $pinjam_alat = Aktivitas::wherestatus('pinjam')->sum('status');
        $kembali_alat = Aktivitas::wherestatus('kembali')->sum('status');
        $baik_alat = Peralatan::wherekondisi('Baik')->sum('kondisi');
        $rusak_alat = Peralatan::wherekondisi('Rusak')->sum('kondisi');
        $dalamperbaikan_alat = Peralatan::wherekondisi('Dalam perbaikan')->sum('kondisi');
        $jenis_alat = Peralatan::with('jenis')->get()->groupBy('jenis.nama_jenis');
        $jumlahbyjenis = $jenis_alat->map(function($query){
            return $query->count();
        });

        $dataPinjamByWeek = Aktivitas::whereStatus('pinjam')->get()->sortByDesc('tgl_pinjam')->groupBy(function($date) {
            return Carbon::parse($date->tgl_pinjam)->format('W, M Y');
        })->take(5)->reverse();
        $dataKembaliByWeek = Aktivitas::whereStatus('kembali')->get()->sortByDesc('tgl_pinjam')->groupBy(function($date) {
            return Carbon::parse($date->tgl_pinjam)->format('W, M Y');
        })->take(5)->reverse();

        $shortDataPinjamByWeek = $dataPinjamByWeek->map(function($query){
            return $query->count();
        });
        $shortDataKembaliByWeek = $dataKembaliByWeek->map(function($query){
            return $query->count();
        });

        return view('alat.dashboard', compact(
            'title',
            'active',
            'peralatans',
            'baik_alat',
            'rusak_alat',
            'dalamperbaikan_alat',
            'mahasiswas',
            'shortDataPinjamByWeek',
            'shortDataKembaliByWeek',
            'jumlahbyjenis',
            'pinjam_alat',
            'kembali_alat'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peralatan  $Peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Peralatan $Peralatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peralatan  $Peralatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peralatan $Peralatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peralatan  $Peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peralatan $Peralatan)
    {
        //
    }
}
