<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aktivitas;
use App\Models\Mahasiswa;
use App\Models\Peralatan;

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
        $peralatans = Peralatan::all();
        $baik_alat = Peralatan::whereKondisi('Baik')->sum('kondisi');
        $rusak_alat = Peralatan::whereKondisi('Rusak')->sum('kondisi');
        $dalamperbaikan_alat = Peralatan::whereKondisi('Dalam perbaikan')->sum('kondisi');
        $mahasiswas = Mahasiswa::sum('id');

        return view('alat.dashboard', compact(
            'title',
            'active',
            'peralatans',
            'baik_alat',
            'rusak_alat',
            'dalamperbaikan_alat',
            'mahasiswas'
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
