@extends('alat.layout.main')
@include('alat.partials.navbar')

@section('container')
 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="py-3">
        <h2>Ubah Data Mahasiswa</h2>
    </div>

    <div class="card">
        <div class="card-header">{{$mahasiswa->nama_mahasiswa}}</div>
        <div class="card-body">
            <form action="{{ url('/alat/mahasiswa/' .$mahasiswa->id) }}" method="post">
                @csrf
                @method("PATCH")
                <input type="hidden" name="id" id="id" value="{{$mahasiswa->id}}" id="id" />
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm mb-2 @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa" value="{{$mahasiswa->id_mahasiswa}}" required value="{{ old('id_mahasiswa') }}">
                    <label for="id_mahasiswa">Nomor Induk Mahasiswa</label>
                    @error('id_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm mb-2 @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" value="{{$mahasiswa->nama_mahasiswa}}" required value="{{ old('nama_mahasiswa') }}">
                    <label for="nama_mahasiswa">Nama Mahasiswa</label>
                    @error('nama_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm mb-4 @error('no_hp_mahasiswa') is-invalid @enderror" id="no_hp_mahasiswa" name="no_hp_mahasiswa" value="{{$mahasiswa->no_hp_mahasiswa}}" required value="{{ old('no_hp_mahasiswa') }}">
                    <label for="no_hp_mahasiswa">Nomor HP Mahasiswa</label>
                    @error('no_hp_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <table>
                      <tr>
                        <td class="col-1"><a href="/alat/pendataanmahasiswa" type="button" class="btn btn-outline-primary col-8"> 
                          <i class="bi bi-arrow-left-circle"></i>  
                            Kembali
                          </a></td>
                        <td class="col-3"><button class="btn btn-outline-success col-5" type="submit">
                            Ubah Data
                        </button></td>
                      </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
 
@endsection