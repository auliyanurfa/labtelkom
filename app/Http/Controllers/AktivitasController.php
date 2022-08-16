<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use App\Models\Mahasiswa;
use App\Models\Aktivitas;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aktivitass = Aktivitas::with('peralatan', 'mahasiswa');
        
        if(request()->ajax()){
            return datatables()->of($aktivitass)
            ->editColumn('tgl_pinjam', function($request){
                $formatDate = Carbon::parse($request->created_at)->toDateTimeString();
                return $formatDate;
            })
            ->editColumn('tgl_kembali', function($request){
                $formatDate = Carbon::parse($request->updated_at)->toDateTimeString();
                return $formatDate;
            })
            ->addColumn('action', function($row){
                // $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="update m-1"><i class="fa-solid fa-trash-can"></i></a>';
                $btn = '<a href="javascript:void(0)" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view ('alat.aktivitas.indexaktivitas',[
            'title' => 'Peminjaman dan Pengembalian',
            "date" =>Carbon::parse()->isoFormat('LLLL'),
            "peralatans" => Peralatan::all(),
            "mahasiswas" => Mahasiswa::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search_barcode = $request->get('term1');
        $result_barcode = Peralatan::where('barcode', 'LIKE', '%' . $search_barcode . '%')->get();
        return($result_barcode);
        return response()->json($result_barcode);

        $search_id_mahasiswa = $request->get('term2');
        $result = Mahasiswa::where('id_mahasiswa', 'LIKE', '%' . $search_id_mahasiswa . '%')->get();
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
        $peralatan = Peralatan::where('barcode', $request->barcode)->update([ 
            'jml_alat' => $request->jml_alat -1,
        ]);
        
        $aktivitass = Aktivitas::create([                
                'barcode' => $request->barcode,
                'nama_alat' => $request->nama_alat,
                'id_mahasiswa' => $request->id_mahasiswa,
                'nama_mahasiswa' => $request->nama_mahasiswa,
            ]);

        if($aktivitass !==0 && $peralatan !==0){
            $success = true;
            $message = "Data berhasil masuk!";
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
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function show(Aktivitas $aktivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Aktivitas $aktivitas, $id)
    {
        $data = Aktivitas::findOrFail($id);
        return view('peminjamandanpengembalian.update', [
            compact('data'),
            'title' => 'Aktivitas',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aktivitass = Aktivitas::find($id);

        $aktivitass->update([
                'status' => 'kembali'
                ]);

        $peralatan = Peralatan::where('barcode', $request->barcode)->update([ 
            'jml_alat' => $request->jml_alat -1,
        ]);

        return redirect('/alat/peminjamandanpengembalian')->with('success', 'Terima Kasih Peralatan Sudah Dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aktivitas  $aktivitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aktivitas $aktivitas, $id)
    {
        Aktivitas::find($id)->delete();
        return redirect()->route('peminjamandanpengembalian.destroy');
    }
}
