<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jeniss = Jenis::all();
        if($request->ajax()){
            $allData = datatables()->of($jeniss)
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
        return view('alat.jenis.indexjenis', [
            "title" => "Jenis",
            "jeniss" => Jenis::all(),
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
            'nama_jenis' => 'required',
            'kode_jenis' => 'required|unique:jeniss,kode_jenis|max:4',
        ]);

        $create = Jenis::create($validatedData);
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
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jeniss = Jenis::find($id);
        return response()->json($jeniss);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jeniss = Jenis::find($id);
        return response()->json($jeniss);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validatedData = request()->validate([
            'nama_jenis' => 'required',
            'kode_jenis' => 'required|unique:jeniss,kode_jenis,'.$id.'|max:4',
        ]);
        $update = Jenis::find($id)->update($validatedData);
        if($update == 1){
            $success = true;
            $message = "Data Jenis berhasil diubah!";
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
     * @param  \App\Models\Jenis  $Jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Jenis::destroy($id);
        if($destroy == 1){
            $success = true;
            $message = "Data jenis berhasil dihapus!";
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
