<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use PDF;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::all();

        if($request->ajax()){
            $allData = datatables()->of($mahasiswas)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-url="'.route('pendataanmahasiswa.edit', $row->id).'" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view('alat.mahasiswa.indexmahasiswa', [
            "title" => "Mahasiswa",
            "date" => Carbon::parse()->isoFormat('LLLL'),
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
            'id_mahasiswa' => 'required|min:5',
            'nama_mahasiswa' => 'required',
            'no_hp_mahasiswa' => 'required|max:15',
        ]);

        $create = Mahasiswa::create($validatedData);
        if($create !== 0){
            $success = true;
            $message = "Data berhasil ditambahkan!";
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
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswas = Mahasiswa::find($id);
        return response()->json($mahasiswas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $mahasiswas = Mahasiswa::whereId($id)->first();
        return response()->json($mahasiswas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validatedData = request()->validate([
            'id_mahasiswa' => 'required|min:5',
            'nama_mahasiswa' => 'required',
            'no_hp_mahasiswa' => 'required|max:15',
        ]);

        $update = Mahasiswa::whereId($id)->update($validatedData);
        if($update == 1){
            $success = true;
            $message = "Data Alat berhasil diubah!";
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
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Mahasiswa::whereId($id)->delete();
        if($destroy == 1){
            $success = true;
            $message = "Data Alat berhasil dihapus!";
        }else{
            $success= true;
            $message = "Failed!";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function datamahasiswa(){
        $mahasiswas = Mahasiswa::all();
        if(request()->ajax()){
            return datatables()->of($mahasiswas);
        }

        return view ('alat.mahasiswa.datamahasiswa',[
            'title' => 'Data Mahasiswa',
                        "date" =>Carbon::parse()->isoFormat('LLLL'),
        ]);

    }

}
