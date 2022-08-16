@extends('bahan.layout.main')


  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12 p-5 mb-4 bg-light rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data Bahan Habis Pakai</h1>
            <p class="col-md-10 fs-5">Data bahan habis pakai material praktikum Lab Telkom Barat. <h6>{{ $date }}</h6></p>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <form action="/BHP/material" class="d-flex ms-0 col-sm-6 mb-4">
          <input class="form-control me-2" type="text" placeholder="Search by Name / Type" aria-label="Search" name="search" value="{{ request('search') }}">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="col-sm-3 mb-1">
        <a href="/BHP/material/create" type="button" class="btn btn-outline-primary">  
              Tambah BHP
        </a>
        </div>
        <div class="col-sm-3 mb-1">
        <a href="/BHP/material/unit/create" type="button" class="btn btn-outline-primary">  
              Tambah Jenis
        </a>
        </div>
      </div>

      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
         </div>
      @endif
      <div class="container"> 
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Material</th>
                  <th scope="col">Jenis Material</th>
                  <th scope="col">Barcode</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach($materials as $material)
                <tr>
                  <th><?= $i; ?></th>
                  <td>{{ $material["name_material"] }}</td>
                  <td>{{ $material->unit->name_unit }}</td>
                  <td>{!! DNS1D::getBarcodeSVG($material->barcode, "C39") !!}</td>
                  <td>
                    <a href="/BHP/material/{{ $material->id }}/edit"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="/BHP/material/{{ $material->id }}" class=""><i class="bi bi-eye"></i></a>
                    <a href="/BHP/materials/{{ $material->id }}" class=""><i class="bi bi-printer-fill"></i></a>
                    <form action="/BHP/material/{{ $material->id }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button onclick="return confirm('are you sure ?')"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    
                  </td>
                </tr>
                <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
            {{ $materials->links() }}
          </div>
        </div>
    </main>
  </div>
</div>


@endsection

    