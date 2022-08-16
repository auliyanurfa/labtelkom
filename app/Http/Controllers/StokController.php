<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Carbon\Carbon;
use PDF;

class StokController extends Controller
{
    public function index(){
        return view('bahan.stok.stok', [
            'title' => "Stok",
            'active' => "stok",
            "materials" => Material::latest()->filter(request(['search']))->paginate(10),
            "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);
    }
    public function excel(){
        return Excel::download(new BHPExport, 'BHP.xlsx');
    }

    public function cetak_pdf(){
        $materials = Material::all();
        $date = Carbon::parse()->isoFormat('LLLL');

        $pdf = PDF::loadview('bahan/stok/stok_pdf', ['materials' => $materials, 'date' =>$date]);
        return $pdf->download('stok_BHP.pdf');
    }
}
