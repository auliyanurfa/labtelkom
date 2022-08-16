<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS1D;
use Datatables;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Contracts\DataTable;

use function PHPUnit\Framework\returnSelf;

class BHPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bhps = Material::with('unit');
        if($request->ajax()){
            $allData = datatables()->of($bhps)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="read m-1"><i class="bi bi-eye"></i></a>';
                $btn .= '<a href="/BHP/materials/'.$row->id.'" data-id="'.$row->id.'" class="print m-1" ><i class="bi bi-printer-fill"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view('bahan.bhp', [
            "title" => "bhp",
            "date" =>Carbon::parse()->isoFormat('LLLL'),
            "units" => Unit::all(),
        ]);
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
        $validatedData = $request->validate([
            'name_material' => 'required|max:255',
            'barcode' => 'required|min:5',
            'spesifikasi' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'stok' => 'required | numeric',
            'satuan' => 'required',
            'location' => 'required'
        ]);

        $create = Material::create($validatedData);
        if($create !== 0){
            $success = true;
            $message = "Data berhasil masuk!";
        }else{
            $success= true;
            $message = "Failed!";
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
    public function show($id)
    {
        $bhps = Material::find($id);
        return response()->json($bhps);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bhps = Material::find($id);
        return response()->json($bhps);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validatedData = request()->validate([
            'name_material' => 'required|max:255',
            'barcode' => 'required|min:5',
            'spesifikasi' => 'required',
            'type' => 'required',
            'unit_id' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
            'location' => 'required'
        ]);
        $update = Material::find($id)->update($validatedData);
        if($update == 1){
            $success = true;
            $message = "Data BHP update success!";
        }else{
            $success= true;
            $message = "Failed!";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Material::destroy($id);
        if($destroy == 1){
            $success = true;
            $message = "Data BHP delete success!";
        }else{
            $success= true;
            $message = "Failed!";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
