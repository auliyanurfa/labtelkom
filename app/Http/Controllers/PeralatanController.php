<?php

namespace App\Http\Controllers;
use App\Models\Peralatan;
use App\Models\Jenis;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS1D;
use Datatables;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Contracts\DataTable;

class PeralatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $peralatans = Peralatan::with('jenis', 'lokasi');

        if($request->ajax()){
            $allData = datatables()->of($peralatans)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="read m-1"><i class="bi bi-eye"></i></a>';
                $btn .= '<a href="/alat/printbarcode/'.$row->id.'" data-id="'.$row->id.'" class="print m-1" ><i class="bi bi-printer-fill"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }
        return view('alat.peralatan.indexperalatan', [
            "title" => "peralatan",
            "date" => Carbon::parse()->isoFormat('LLLL'),
            "jeniss" => Jenis::all(),
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
            'barcode' => 'required|min:5',
            'nama_alat' => 'required',
            'jenis_id' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun_masuk' => 'required',
            'kondisi' => 'required',
            'lokasi_id' => 'required'
        ]);

        $create = Peralatan::create($validatedData);
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
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peralatans = Peralatan::find($id);
        return response()->json($peralatans);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peralatans = Peralatan::find($id);
        return response()->json($peralatans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validatedData = request()->validate([
            'barcode' => 'required|min:5',
            'nama_alat' => 'required',
            'jenis_id' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'tahun_masuk' => 'required',
            'kondisi' => 'required',
            'lokasi_id' => 'required'
        ]);
        $update = Peralatan::find($id)->update($validatedData);
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
     * @param  \App\Models\Peralatan  $peralatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Peralatan::destroy($id);
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

    public function dataperalatan(Request $request)
    {
        $peralatans = Peralatan::with('jenis', 'lokasi');

        return view('alat.peralatan.laporanperalatan', [
            "title" => "peralatan",
            "date" => Carbon::parse()->isoFormat('LLLL'),
            "jeniss" => Jenis::all(),
            "lokasis" => Lokasi::all(),
            "peralatans" => datatables()->of($peralatans)
        ]);
    }

}
