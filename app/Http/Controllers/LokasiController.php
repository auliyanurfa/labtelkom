<?php

namespace App\Http\Controllers;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lokasis = Lokasi::all();
        if($request->ajax()){
            $allData = datatables()->of($lokasis)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view('alat.lokasi.indexlokasi', [
            "title" => "Lokasi",
            "lokasis" => Lokasi::all(),
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
            'lab' => 'required',
            'almari' => 'required',
            'kode_lokasi' => 'required|unique:lokasis,kode_lokasi|max:3',
        ]);

        $create = Lokasi::create($validatedData);
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
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasis = Lokasi::find($id);
        return response()->json($lokasis);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasis = Lokasi::find($id);
        return response()->json($lokasis);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validatedData = request()->validate([
            'lab' => 'required',
            'almari' => 'required',
            'kode_lokasi' => 'required|unique:lokasis,kode_lokasi,'.$id.'|max:3',
        ]);
        $update = Lokasi::find($id)->update($validatedData);
        if($update == 1){
            $success = true;
            $message = "Data Lokasi berhasil diubah!";
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
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Lokasi::destroy($id);
        if($destroy == 1){
            $success = true;
            $message = "Data Lokasi berhasil dihapus!";
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
