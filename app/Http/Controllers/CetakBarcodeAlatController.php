<?php

namespace App\Http\Controllers;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PDF;

class CetakBarcodeAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function show(Peralatan $peralatan)
        {
            $pdf = PDF::loadview('alat.peralatan.cetakbarcode', ['peralatan' => $peralatan]);
            return $pdf->download('barcode.pdf');

        }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Peralatan $peralatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peralatan $peralatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peralatan $peralatan)
    {
        //
    }
}
