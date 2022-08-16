<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Bhppengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class BHPPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluarans = Bhppengeluaran::all();
        if(request()->ajax()){
            return datatables()->of($pengeluarans)
            ->editColumn('created_at', function($request){
                $formatDate = Carbon::parse($request->created_at)->toDateTimeString();
                return $formatDate;
            })
            ->make(true);
        }

        return view ('bahan.pengeluaran',[
            'title' => 'Pengeluaran',
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
        Material::where('barcode', $request->barcode)->update([ 
            'stok'=> $request->stok - $request->stok_keluar,
            'stok_keluar' => $request->stok_keluar
        ]);
        $bhp = Bhppengeluaran::Create([
            'name_material'=>$request->name_material,
            'barcode' => $request->barcode,
            'stok'=> $request->stok - $request->stok_keluar,
            'stok_keluar'=> $request->stok_keluar,
            'stok_awal'=> $request->stok,
            'satuan'=> $request->satuan,
        ]);

        if($bhp !== 0){
            $success = true;
            $message = "Stok berhasil keluar";
        } else{
            $success = true;
            $message = "Failed";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
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
        $pengeluarans = Bhppengeluaran::all();
        if(request()->ajax()){
            return datatables()->of($pengeluarans)
            ->editColumn('created_at', function($request){
                $formatDate = Carbon::parse($request->created_at)->toDateTimeString();
                return $formatDate;
            })
            ->make(true);
        }

        return view ('bahan.laporanpengeluaran',[
            'title' => 'Laporan Pengeluaran BHP',
            "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);
  
    }
}
