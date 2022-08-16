@extends('alat.layout.main')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="col-12 p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-7 fw-bold">Data Mahasiswa</h1>
          <p class="col-md-10 fs-5">Data mahasiswa peminjam alat praktikum Lab Telkom Barat.</p>
        </div>
      </div>
    </div>

      <div class="row">
        <div>
          <table class="mb-4">
            <tr>
              <td class="col-1 mb-3"><a href="{{ url('/alat/cetakdatamahasiswa') }}" type="button" class="btn btn-outline-primary title="Tambah Mahasiswa">  
                <i aria-hidden="true"></i> Ekspor                      
              </a></td>
              <td>
                <form action="/alat/pendataanmahasiswa" class="d-flex mx-auto col-8 mb-0">
                  <input class="form-control me-1" type="text" placeholder="Cari berdasarkan nama / NIM" aria-label="Search" name="search" value="{{ request('search') }}">
                  <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>
              </td>
            </tr>
          </table>
      </div>  

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">NIM Mahasiswa</th>
          <th scope="col">Nama Mahasiswa</th>
          <th scope="col">Nomor HP Mahasiswa</th>
        </tr>
      </thead>
      <tbody>
        @foreach($mahasiswas as $siswa)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{!! DNS1D::getBarcodeSVG($siswa->id_mahasiswa, "C39") !!}</td>
          <td>{{ $siswa->nama_mahasiswa }}</td>
          <td>{{ $siswa->no_hp_mahasiswa }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $mahasiswas->links() }}
@endsection

