@extends('alat.layout.main')
@include('alat.partials.navbar')

@section('container')
 
<main class="md-8 ms-sm-auto col-lg-10 px-md-4">
    <div class="py-3">
        <h2>{{ $mahasiswa->nama_mahasiswa }}</h2>
    </div>

    <div class="card">
        <div class="card-header">Data Mahasiswa</div>
        <div class="card-body">
        
            <div>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <th style="width: 250px;">Nomor Induk Mahasiswa</th>
                            <th style="width: 10px;">:</th>
                            <td>{{ $mahasiswa->id_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>:</th>
                            <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP Mahasiswa</th>
                            <th>:</th>
                            <td>{{ $mahasiswa->no_hp_mahasiswa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <table>
              <tr>
                <td class="col-8 px-3"><a href="/alat/pendataanmahasiswa" type="button" class="btn btn-outline-primary col-8 mb-3"> 
                  <i class="bi bi-arrow-left-circle"></i>  
                    Kembali
                  </a></td>
              </tr>
            </table>
        </div>
        </div>
    </div>
    
@endsection