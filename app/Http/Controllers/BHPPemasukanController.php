<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Bhppemasukan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Datatables;
use GrahamCampbell\ResultType\Success;
use LDAP\Result;
use mysqli;

class BHPPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukans = Bhppemasukan::all();
        if(request()->ajax()){
            return datatables()->of($pemasukans)
            ->editColumn('created_at', function($request){
                $formatDate = Carbon::parse($request->created_at)->toDateTimeString();
                return $formatDate;
            })
            ->make(true);
        }

        return view('bahan.pemasukan',[
            'title' => 'Pemasukan',
            "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search = $request->get('term');
        $result = Material::where('barcode', 'LIKE', '%' . $search . '%')->get();
        return($result);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $material = Material::where('barcode', $request->barcode)->update([
            'stok' => $request->stok + $request->stok_masuk,
            'stok_masuk'=> $request->stok_masuk,
        ]);

        $bhp = Bhppemasukan::Create([
            'name_material'=>$request->name_material,
            'barcode' => $request->barcode,
            'stok'=> $request->stok + $request->stok_masuk,
            'stok_masuk'=> $request->stok_masuk,
            'stok_awal'=> $request->stok,
            'satuan'=> $request->satuan,
        ]);

        if($bhp !==0 && $material !==0){
            $success = true;
            $message = "Stok berhasil masuk!";
        } else{
            $success = false;
            $message = "Failed";
        }
        // Bhppemasukan::Create($rules);

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

        // Bhppemasukan::Create($rules);

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
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

    public function laporan(){
        $pemasukans = Bhppemasukan::all();
        if(request()->ajax()){
            return datatables()->of($pemasukans)
            ->editColumn('created_at', function($request){
                $formatDate = Carbon::parse($request->created_at)->toDateTimeString();
                return $formatDate;
            })
            ->make(true);
        }

        return view ('bahan.laporanpemasukan',[
            'title' => 'Laporan Pemasukan BHP',
                        "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);

    }
}
