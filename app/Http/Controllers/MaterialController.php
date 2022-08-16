<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bahan.material', [
            "title" => "Materials",
            "materials" => Material::latest()->filter(request(['search']))->paginate(10) ,
            "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bahan.create', [
            'title' => 'Materials',
            'units' => Unit::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_material' => 'required|max:255',
            'barcode' => 'required|min:5',
            'spesifikasi' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'stok' => 'required',
            'stok_masuk' => 'required',
            'satuan' => 'required',
            'location' => 'required'
        ]);

        Material::create($validatedData);

        return redirect('/BHP/material')->with('success', 'BHP berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('bahan.shows', [
            'material' => $material,
            'title' => 'Materials',
            'active' => 'Materials',
            'units' => Unit::where('id', $material->unit_id)->get()
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

        return view('bahan.edit', [
            'title' => 'Edit',
            'material' => $material,
            'units' => Unit::all(),
        ]);
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
        
        $rules = ([
            'unit_id' => 'required',
            'type' => 'required',
            'name_material' => 'required',
            'location' => 'required',
            'spesifikasi' => 'required'
        ]);

        $validatedData = $request->validate($rules);
    
        Material::where('id', $material->id)->update($validatedData);
        return redirect('/BHP/material')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        Material::destroy($material->id);
        return redirect('BHP/material')-> with('success', 'Data Bahan Habis Pakai berhasil di hapus!');
    }

}
