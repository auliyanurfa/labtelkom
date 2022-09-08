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
        $pinjam_alat = Aktivitas::whereStatus('pinjam')->count();
        $kembali_alat = Aktivitas::whereStatus('kembali')->count();
        $baik_alat = Peralatan::whereKondisi('Baik')->count();
        $rusak_alat = Peralatan::whereKondisi('Rusak')->count();
        $dalamperbaikan_alat = Peralatan::whereKondisi('Dalam perbaikan')->count();
        $jenis_alat = Peralatan::with('jenis')->get()->groupBy('jenis.nama_jenis');
        $jumlahbyjenis = $jenis_alat->map(function($query){
            return $query->count();
        });
        $jenis_alatNewest = Peralatan::with('jenis')->where('tahun_masuk', date('Y'))->get()->groupBy('jenis.nama_jenis');
        $jumlahbyjenisNewest = $jenis_alatNewest->map(function($query){
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

        $alatPerTahun = Peralatan::get()->sortByDesc('tahun_masuk')->groupBy(function($date) {
            return Carbon::parse($date->tgl_pinjam)->format('Y');
        })->map(function($query){
            return $query->sum('jumlah_alat');
        });

        $alatRusakAll = Peralatan::with('jenis')->whereKondisi('Rusak')->get()->groupBy('jenis.nama_jenis')->map(function($query){
            return $query->count();
        });
        $alatBaikAll = Peralatan::with('jenis')->whereKondisi('Baik')->get()->groupBy('jenis.nama_jenis')->map(function($query){
            return $query->count();
        });
        $alatDalamPerbaikanAll = Peralatan::with('jenis')->whereKondisi('Dalam Perbaikan')->get()->groupBy('jenis.nama_jenis')->map(function($query){
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
            'jumlahbyjenisNewest',
            'pinjam_alat',
            'kembali_alat',
            'alatPerTahun',
            'alatRusakAll',
            'alatBaikAll',
            'alatDalamPerbaikanAll'
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
