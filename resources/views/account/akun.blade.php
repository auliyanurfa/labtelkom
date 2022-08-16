@extends('bahan.layout.main')


  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3 col-12">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data User</h1>
            <p class="col-md-10 fs-5">Halaman ini berisi data lengkap user.</p>
          </div>
        </div>
      </div>
      <div class="container">
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
        <div class="row">
          <div class="col-12 table-responsive">      
            <br>
                <div class="row mb-3">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->username }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->name }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->NIP }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->email }}" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">No telepon</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->phone }}" disabled>
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="formGroupExampleInput" value= "{{ auth()->user()->address }}" disabled>
                    </div>
                </div>
                <a href="/BHP/akun/{{ auth()->user()->id }}/edit" class="btn btn-outline-warning mb-3">Edit</a>    
            </div>
        </div>
      </div>
    </main>
@endsection

    