@extends('bahan.layout.main')

@section('container')



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="card">
      <div class="card-body">
        Detail User
      </div>
    </div>

    <form>

      <div class="row">
        <div class="col-md-6">
            <div class="row my-3">
            <label for="name" class="col-md-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="name" value="{{ $user->name }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="role_id" class="col-md-2 col-form-label">Level</label>
            <div class="col-sm-10">
              @foreach($roles as $role)
              <input type="email" class="form-control" id="role_id" value="{{ $role->role_name }}" disabled>
              @endforeach
            </div>
          </div>
          <div class="row my-3">
            <label for="username" class="col-md-2 col-form-label">username</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="username" value="{{ $user->username }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="nip" class="col-md-2 col-form-label">NIP</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="nip" value="{{ $user->NIP }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row my-3">
              <label for="gender" class="col-md-2 col-form-label">Gender</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="gender" value="{{ $user->gender }}" disabled>
              </div>
          </div>
          <div class="row my-3">
            <label for="address" class="col-md-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="address" value="{{ $user->address }}" disabled>
            </div>
          </div>
          <div class="row my-3">
            <label for="phone" class="col-md-2 col-form-label">No telp</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="phone" value="{{ $user->phone }}" disabled>
            </div>
          </div>
        </div>
      </div>
      <a href="/BHP/user" class="btn btn-secondary">Back</a>
      </div>
    </form>
    
</main>


@endsection