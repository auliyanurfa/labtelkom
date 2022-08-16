<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use PDF;


class MahasiswaController extends Controller
{
  
    public function index()
    {
        return view('alat.mahasiswa.indexmahasiswa', [
            "title" => "Mahasiswa",
            "mahasiswas" => Mahasiswa::latest()->filter(request(['search']))->paginate(15)
        ]);
    }

    
    public function create()
    {
        return view('alat.mahasiswa.createmahasiswa',[
            "title" => "Mahasiswa",
        ]);
    }

   
    public function store(Request $request, Mahasiswa $mahasiswa)
    {        
            if($id_mahasiswa ==  $mahasiswa->id_mahasiswa ){
                echo "<script type='text/javascript'>alert('Nomor Induk Mahassiwa sudah digunakan');</script>";
                }
            else{
                $input = $request->all();
                $request->validate([
                    'id_mahasiswa' => 'required',            
                    'nama_mahasiswa' => 'required',
                    'no_hp_mahasiswa' => 'required',
                ]);
                Mahasiswa::create($input);
            return redirect('/alat/pendataanmahasiswa')->with('success', 'Data Mahasiswa Berhasil Ditambahkan!'); 
    }
}

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */

    
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('alat.mahasiswa.showmahasiswa',[
            'mahasiswa' => $mahasiswa,
            'title' => 'Mahasiswa',
            'active' => 'Mahasiswa',
            'mahasiswas' => Mahasiswa::where('id', $mahasiswa->id_mahasiswa)->get(),
        ]);
    }


    public function edit(Mahasiswa $mahasiswa)
    {

        return view('alat.mahasiswa.editmahasiswa', [
            'title' => 'Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'mahasiswas' => Mahasiswa::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
  
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData=$request->validate([
            'id_mahasiswa' => 'required',            
            'nama_mahasiswa' => 'required',
            'no_hp_mahasiswa' => 'required',    
        ]);   

        Mahasiswa::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->update($validatedData);
        return redirect('/alat/pendataanmahasiswa')->with('success', 'Data Mahasiswa Berhasil Diubah!');  
    }

   
    public function destroy($id_mahasiswa)
    {
        Mahasiswa::destroy($id_mahasiswa);
        return redirect('/alat/pendataanmahasiswa')->with('success', 'Data Mahasiswa Berhasil Dihapus!');  
    }

    public function datamahasiswa()
    {
        return view('alat.mahasiswa.datamahasiswa', [
        "title" => "Data Mahasiswa",
        "mahasiswas" => Mahasiswa::latest()->filter(request(['search']))->paginate(15)
    ]);
    }

}
