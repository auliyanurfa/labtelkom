@extends('alat.layout.main')
@include('alat.partials.navbar')

@section('container')
 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="py-3">
    <h2>Tambah Data Mahasiswa</h2>
</div>

<div class="card">
  <div class="card-body">
      <form action="{{ url('alat/pendataanmahasiswa') }}" method="post">
        {!! csrf_field() !!}

        @if(session()->has('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
          </div>
        @endif

        <div class="form-floating">
            <input type="text" class="form-control form-control-sm mb-2 @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa" placeholder="43118002" required value="{{ old('id_mahasiswa') }}">
            <label for="id_mahasiswa">Nomor Induk Mahasiswa</label>
            @error('id_mahasiswa')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating">
          <input type="text" class="form-control form-control-sm mb-2 @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Auliya Nisa Nurfadzilla" required value="{{ old('nama_mahasiswa') }}">
          <label for="nama_mahasiswa">Nama Mahasiswa</label>
          @error('nama_mahasiswa')
          <div class="invalid-feedback">
              {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" class="form-control form-control-sm mb-4 @error('no_hp_mahasiswa') is-invalid @enderror" id="no_hp_mahasiswa" name="no_hp_mahasiswa" placeholder="08xx xxxx xxxx" required value="{{ old('no_hp_mahasiswa') }}">
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
                  Tambah Data
              </button></td>
            </tr>
          </table>
        </div>
      </form>
  </div>
</div>
 
@endsection