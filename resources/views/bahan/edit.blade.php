@extends('bahan.layout.main')

@section('container')



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="card">
      <div class="card-body">
        Edit Data Bahan Habis Pakai
      </div>
    </div>

    <form method="post" action="/BHP/material/{{ $material->id }}">
      @method('put')
      @csrf
      <div class="row">
        <div class="col-md-6">
            <div class="row my-3">
              <label for="name_material" class="col-md-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name_material" name="name_material" required value="{{ old('name_material', $material->name_material) }}">
              </div>
            </div>          
          <div class="row my-3">
            <label for="unit_id" class="col-md-2 col-form-label">Unit</label>
            <div class="col-sm-10">
              <select name="unit_id" class="form-select">
              @foreach($units as $unit)
              @if(old('unit_id', $material->unit_id) == $unit->id)
              <option value="{{ $unit->id }}" selected>{{ $unit->name_unit }}</option>
              @else
              <option value="{{ $unit->id }}">{{ $unit->name_unit }}</option>
              @endif
              @endforeach
              </select>
            </div>
          </div>
          <div class="row my-3">
            <label for="type" class="col-md-2 col-form-label">Type</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="type" id="type" required value="{{ old('type', $material->type) }}">
            </div>
          </div>
          <div class="row my-3">
            <label for="stok" class="col-md-2 col-form-label">Stok</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="stok" name="stok" required value="{{ old('stok',$material->stok) }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="satuan" class="col-md-2 col-form-label">Satuan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="satuan" name="satuan" required value="{{ old('satuan',$material->satuan) }}" disabled>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row my-3">
              <label for="location" class="col-md-2 col-form-label">Location</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="location" name="location" required value="{{ old('location',$material->location) }}">
              </div>
          </div>
          <div class="row my-3">
            <label for="spesifikasi" class="col-md-2 col-form-label">Spesifikasi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" required value="{{ old('spesifikasi',$material->spesifikasi) }}">
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
      <a href="/BHP/material" class="btn btn-outline-primary">
        Back
      </a>
      <button class="btn btn-outline-success col-sm-2" type="submit">
        Update Data
      </button>
      </div>
    </form>
    
</main>


@endsection