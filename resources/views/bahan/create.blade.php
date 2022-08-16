@extends('bahan.layout.main')

@section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="d-felx justify-content-center row">
            <h1 class="h4 mb-3 fw-normal text-center">Tambah Data Bahan Habis Pakai</h1>
                <div class="col-sm-6 col-form-label col-form-label-sm text-center">
                <form action="/BHP/material" method="post">
                    @csrf 
                    <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('name_material') is-invalid @enderror" id="name_material" name="name_material" placeholder="Ariana Grande" required value="{{ old('name_material') }}">
                        <label for="name_material">Nama Bahan Habis Pakai</label>
                        @error('name_material')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="barcode" required value="{{ old('barcode') }}">
                        <label for="barcode">barcode</label>
                        @error('barcode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('spesifikasi') is-invalid @enderror" id="spesifikasi" name="spesifikasi" placeholder="spesifikasi" required value="{{ old('spesifikasi') }}">
                        <label for="spesifikasi">spesifikasi</label>
                        @error('spesifikasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('type') is-invalid @enderror" id="floatingInput" name="type" placeholder="exmaple@esmoa.com"  required value="{{ old('type') }}">
                        <label for="floatingInput">type</label>
                        @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <select class="form-select mb-2" id="unit_id" name="unit_id" required value="{{ old('unit_id') }}">
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name_unit }}</option>
                        @endforeach
                        </select>
                        <label for="floatingSelect">Jenis</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('stok') is-invalid @enderror" id="floatingInput" name="stok" placeholder="exmaple@esmoa.com"  required value="{{ old('stok') }}">
                        <label for="floatingInput">stok</label>
                        @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('location') is-invalid @enderror" id="floatingInput" name="location" placeholder="exmaple@esmoa.com"  required value="{{ old('location') }}">
                        <label for="floatingInput">location</label>
                        @error('location')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <select class="form-select mb-2 @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required value="{{ old('satuan') }}">
                            <option selected>Pilih</option>
                            <option value="pcs">pcs</option>
                            <option value="liter">liter</option>
                            <option value="meter">meter</option>
                        </select>
                        <label for="floatingSelect">satuan</label>
                        @error('satuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                    <a href="/BHP/material" type="button" class="btn btn-outline-primary col-7"> 
                    <i class="bi bi-arrow-left-circle"></i>  
                    Back
                    </a>
                    </div>
                    <div class="col-8">
                    <button class="btn btn-outline-success col-7" type="submit">
                        Add BHP
                    </button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection

    