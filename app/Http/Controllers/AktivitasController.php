<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use App\Models\Mahasiswa;
use App\Models\Aktivitas;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Throwable;

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
                $formatDate = $request->tgl_pinjam ? Carbon::parse($request->tgl_pinjam)->toDateTimeString() : '';
                return $formatDate;
            })
            ->editColumn('tgl_kembali', function($request){
                $formatDate = $request->tgl_kembali ? Carbon::parse($request->tgl_kembali)->toDateTimeString() : '-';
                return $formatDate;
            })
            ->editColumn('status', function($request){
                return Str::upper($request->status);
            })
            ->addColumn('action', function($row){
                // $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="update m-1"><i class="fa-solid fa-trash-can"></i></a>';
                $btn = $row->tgl_kembali !== null ? '' : '<a href="javascript:void(0)" data-url="'.route('peminjamandanpengembalian.edit', $row->id).'" data-update="'.route('peminjamandanpengembalian.update', $row->id).'" data-id="'. $row->id .'" class="edit m-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                // $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'"class="delete m-1"><i class="fa-solid fa-trash-can"></i></a>';
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
        $request->validate([
            'barcode' => 'required',
            'nama_alat' => 'required',
            'id_mahasiswa' => 'required',
            'nama_mahasiswa' => 'required',
        ]);

        $mahasiswa = Mahasiswa::where('id_mahasiswa', $request->id_mahasiswa)->first();

        $peralatanRaw = Peralatan::where('barcode', $request->barcode);
        $singlePeralatan = $peralatanRaw->first();

        if($singlePeralatan->jumlah_alat == 0){

            return response()->json([
                'success' => false,
                'message' => 'Stok Tidak Tersedia',
            ]);
        }

        $peralatan = $peralatanRaw->decrement('jumlah_alat', 1);

        $aktivitass = Aktivitas::create([
            'peralatan_id' => $singlePeralatan->id,
            'mahasiswa_id' => $mahasiswa->id,
            'tgl_pinjam' => Carbon::now(),
            'status' => 'pinjam',
            'kondisi_awal' => $singlePeralatan->kondisi
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
        $data = Aktivitas::with('peralatan', 'mahasiswa')->whereId($id)->first();
        return response()->json($data);
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
        $request->validate([
            'barcode' => 'required',
            'kondisi' => 'required'
        ]);
        $aktivitass = Aktivitas::whereId($id);

        $aktivitass->update([
            'tgl_kembali' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 'kembali',
            'kondisi_akhir' => $request->kondisi
        ]);

        $peralatanRaw = Peralatan::where('barcode', $request->barcode);
        $peralatan = $peralatanRaw->increment('jumlah_alat', 1);
        $peralatanRaw->update(['kondisi' => $request->kondisi]);

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

    public function searchAlat(Request $request)
    {
        if($request->ajax()){
            try{
                $alat = Peralatan::whereBarcode($request->barcode)->first();
                if($alat == null){
                    throw 'Not Match';
                }
                return response()->json(['success' => true, 'msg' => $alat]);
            } catch (\Throwable $e)
            {
                return response()->json(['success' => false, 'msg' => 'Not Match']);
            }
        }
    }

    public function searchMahasiswa(Request $request)
    {
        if($request->ajax()){
            try{
                $mahasiswa = Mahasiswa::whereIdMahasiswa($request->id)->first();
                if($mahasiswa == null){
                    throw 'Not Match';
                }
                return response()->json(['success' => true, 'msg' => $mahasiswa]);
            } catch (\Throwable $e)
            {
                return response()->json(['success' => false, 'msg' => 'Not Match']);
            }
        }
    }

    public function peminjaman(Request $request)
    {
        if($request->ajax()){
            $aktivitas = Aktivitas::with('peralatan', 'mahasiswa')->select();
            return datatables()->of($aktivitas)
            ->addIndexColumn()
            ->make(true);
        }

        return view('alat.aktivitas.laporanpeminjaman',[
            'title' => 'Laporan Peminjaman',
            "date" =>Carbon::parse()->isoFormat('LLLL')
        ]);
    }

    public function pengembalian(Request $request)
    {
        if($request->ajax()){
            $aktivitas = Aktivitas::with('peralatan', 'mahasiswa')->whereNotNull('tgl_kembali')->select();
            return datatables()->of($aktivitas)
            ->addIndexColumn()
            ->make(true);
        }

        return view('alat.aktivitas.laporanpengembalian',[
            'title' => 'Laporan Pengembalian',
            "date" =>Carbon::parse()->isoFormat('LLLL')
        ]);
    }
}
