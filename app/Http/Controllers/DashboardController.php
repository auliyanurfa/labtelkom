<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Bhppemasukan;
use App\Models\Bhppengeluaran;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class DashboardController extends Controller
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
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        
        return view('bahan.dashboard', [
            "title" => "Dashboard",
            "active" => "dashboard",
            "materials" => Material::all(),
            "pcs_bhpAll" => Material::where([
                'satuan' => 'pcs'
            ])->sum('stok'),
            "liter_bhpAll" => Material::where([
                'satuan' => 'liter'
            ])->sum('stok'),
            "meter_bhpAll" => Material::where([
                'satuan' => 'meter'
            ])->sum('stok'),
            "pcs_in" => Bhppemasukan::where([
                'satuan' => 'pcs'
            ])->sum('stok_masuk'),
            "liter_in" => Bhppemasukan::where([
                'satuan' => 'liter'
            ])->sum('stok_masuk'),
            "meter_in" => Bhppemasukan::where([
                'satuan' => 'meter'
            ])->sum('stok_masuk'),
            "pcs_out" => Bhppengeluaran::where([
                'satuan' => 'pcs'
            ])->sum('stok_keluar'),
            "liter_out" => Bhppengeluaran::where([
                'satuan' => 'liter'
            ])->sum('stok_keluar'),
            "meter_out" => Bhppengeluaran::where([
                'satuan' => 'meter'
            ])->sum('stok_keluar'),

        ]);
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        //
    }
}
