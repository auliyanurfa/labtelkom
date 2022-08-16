@extends('bahan.show')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="d-felx justify-content-center row">
            <h1 class="h4 mb-3 fw-normal text-center">Tambah Jenis Bahan Habis Pakai</h1>
                <div class="col-sm-6 col-form-label col-form-label-sm text-center">
                    <form action="/BHP/material/unit" method="post">
                        @csrf 
                        <div class="form-floating">
                            <input type="text" class="form-control form-control-sm mb-2 @error('name_unit') is-invalid @enderror" id="name_unit" name="name_unit" placeholder="Ariana Grande" required value="{{ old('name_unit') }}">
                            <label for="name_unit">Nama Jenis Bahan Habis Pakai</label>
                            @error('name_unit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-8 d-flex">
                            <a href="/BHP/material" type="button" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left-circle"></i>
                            Back
                            </a>
                            <button class="btn btn-outline-success col-5 ms-2" type="submit">
                                Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
</main>
@endsection