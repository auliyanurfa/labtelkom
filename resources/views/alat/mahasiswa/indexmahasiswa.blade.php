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
                        <td class="col-1 mb-3"><a href="{{ url('/alat/pendataanmahasiswa/create') }}" type="button"
                                class="btn btn-outline-primary" title="Tambah Mahasiswa">
                                <i aria-hidden="true"></i> Tambah
                            </a></td>
                        <td>
                            <form action="/alat/pendataanmahasiswa" class="d-flex mx-auto col-8 mb-0">
                                <input class="form-control me-1" type="text" placeholder="Cari berdasarkan nama / NIM"
                                    aria-label="Search" name="search" value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>

            {{-- @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (session()->has('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('fail') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif --}}

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NIM Mahasiswa</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Nomor HP Mahasiswa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{!! DNS1D::getBarcodeSVG($siswa->id_mahasiswa, 'C39') !!}</td>
                                <td>{{ $siswa->nama_mahasiswa }}</td>
                                <td>{{ $siswa->no_hp_mahasiswa }}</td>
                                <td>
                                    <a href="{{ url('alat/pendataanmahasiswa/' . $siswa->id_mahasiswa) }}"
                                            title="Lihat Data Mahasiswa"><span data-feather="eye"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></span></a>
                                    <a href="{{ url('alat/pendataanmahasiswa/' . $siswa->id_mahasiswa . '/edit') }}"
                                            title="Ubah Data Mahasiswa"><span data-feather="edit"><i
                                                    class="fa fa-pencil-square-o"
                                                    aria-hidden="true"></i></span></a>

                                    <form method="POST"
                                        action="{{ url('alat/pendataanmahasiswa' . '/' . $siswa->id_mahasiswa) }}"
                                        accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button title="Hapus Data Mahasiswa"
                                            onclick="return confirm(&quot;Yakin ingin menghapus data ini?&quot;)"><span
                                                data-feather="trash"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $mahasiswas->links() }}
        @endsection
