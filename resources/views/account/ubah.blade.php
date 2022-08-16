@extends('bahan.layout.main')

@section('container')



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="card">
      <div class="card-body">
        Edit User
      </div>
    </div>

    <form method = "post" action="/BHP/akun/{{ auth()->user()->id }}">
    @method('PUT')
    @csrf
    <div class="container">
        <div class="row">
          <div class="col-12">      
            <br>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"value= "{{ auth()->user()->username }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value= "{{ auth()->user()->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="NIP" class="col-sm-2 col-form-label">NIP</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('NIP') is-invalid @enderror" id="NIP" name="NIP" value= "{{ auth()->user()->NIP }}">
                    @error('NIP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value= "{{ auth()->user()->email }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="phone" class="col-sm-2 col-form-label">No telepon</label>
                    <div class="col-sm-10">
                    <input type="numeric" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value= "{{ auth()->user()->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="formGroupExampleInput" name="address" value= "{{ auth()->user()->address }}">
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="row d-flex justify-content-start">
                    <div class="col-md-1">
                        <a href="/BHP/akun" class="btn btn-outline-primary">
                            Back
                          </a>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-outline-success mb-5">Update</button>       
                    </div>
                </div>
            </div>
        </div>
      </div>
    </form>
</main>


@endsection