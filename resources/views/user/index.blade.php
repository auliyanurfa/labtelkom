@extends('bahan.layout.main')
  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="container">
            <div class="d-felx justify-content-center row">
            <h1 class="h4 mb-3 fw-normal text-center">Menambah User</h1>
                <div class="col-sm-10 col-form-label col-form-label-sm text-center">
                <form action="/BHP/user" method="post">
                    @csrf 
                    <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Ariana Grande" required value="{{ old('name') }}">
                        <label for="name">Nama Lengkap</label>
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('NIP') is-invalid @enderror" id="NIP" name="NIP" placeholder="NIP" required value="{{ old('NIP') }}">
                        <label for="NIP">NIP</label>
                        @error('NIP')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror" id="floatingInput" name="email" placeholder="exmaple@esmoa.com"  required value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control mb-2 @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="password" required>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="phone" required value="{{ old('phone') }}">
                        <label for="phone">Phone</label>
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <select class="form-select mb-2 @error('gender') is-invalid @enderror" id="gender" name="gender" required value="{{ old('gender') }}">
                            <option selected>Pilih</option>
                            <option value="1">P</option>
                            <option value="2">L</option>
                        </select>
                        <label for="floatingSelect">Gender</label>
                        @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('address') is-invalid @enderror" id="address" name="address" placeholder="address" required value="{{ old('address') }}">
                        <label for="address">Alamat</label>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-5">
                        <select class="form-select mb-2 @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required value="{{ old('role_id') }}">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        <label for="role_id">Role</label>
                        @error('role_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <a href="/BHP/user" type="button" class="btn btn-outline-primary"> 
                            <i class="bi bi-arrow-left-circle"></i>  
                            Back
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <button class="btn btn-outline-success" type="submit">
                                Add User
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

    