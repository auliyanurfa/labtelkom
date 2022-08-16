@extends('bahan.layout.main')

@section('container')



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="card">
      <div class="card-body">
        Detail Bahan Habis Pakai
      </div>
    </div>

    <form>
      <div class="row">
        <div class="col-md-6">
            <div class="row my-3">
            <label for="name" class="col-md-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="name" value="{{ $material->name_material }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="unit_id" class="col-md-2 col-form-label">Unit</label>
            <div class="col-sm-10">
              @foreach($units as $unit)
              <input type="email" class="form-control" id="unit_id" value="{{ $unit->name_unit }}" disabled>
              @endforeach
            </div>
          </div>
          <div class="row my-3">
            <label for="type" class="col-md-2 col-form-label">Type</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="type" value="{{ $material->type }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="stok" class="col-md-2 col-form-label">Stok</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="stok" value="{{ $material->stok }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="satuan" class="col-md-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="satuan" value="{{ $material->satuan }}" disabled>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row my-3">
              <label for="lokasi" class="col-md-2 col-form-label">Lokasi</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="lokasi" value="{{ $material->location }}" disabled>
              </div>
          </div>
          <div class="row my-3">
            <label for="spesifikasi" class="col-md-2 col-form-label">Spesifikasi</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="spesifikasi" value="{{ $material->spesifikasi }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="barcode" class="col-md-2 col-form-label">barcode</label>
            <div class="col-sm-10">
              {!! DNS1D::getBarcodeSVG($material->barcode, "C39") !!}
            </div>
          </div>
        </div>
      </div>
      <a href="/BHP/material" class="btn btn-secondary">Back</a>
      </div>
    </form>
    
</main>


@endsection