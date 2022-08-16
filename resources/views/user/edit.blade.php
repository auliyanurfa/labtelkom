@extends('bahan.layout.main')

  @section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="card">
      <div class="card-body">
        Edit User
      </div>
    </div>

    <form method = "post" action="/BHP/user/{{ $user->id }}">
    @method('PUT')
    @csrf
      <div class="row">
        <div class="col-md-6">
            <div class="row my-3">
            <label for="name" class="col-md-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
          </div>
          <div class="row my-3">
            <label for="unit_id" class="col-md-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <select name="role_id" class="form-select">
              @foreach($roles as $role)
              @if(old('role_name', $user->role_id) == $role->id)
              <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
              @else
              <option value="{{ $role->id }}">{{ $role->role_name }}</option>
              @endif
              @endforeach
              </select>
            </div>
          </div>
          <div class="row my-3">
            <label for="nip" class="col-md-2 col-form-label">NIP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nip" name="NIP" value="{{ $user->NIP }}">
            </div>
          </div>
          <div class="row my-3">
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row my-3">
              <label for="gender" class="col-md-2 col-form-label">Gender</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $user->gender }}">
              </div>
          </div>
          <div class="row my-3">
            <label for="address" class="col-md-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
            </div>
          </div>
          <div class="row my-3">
            <label for="phone" class="col-md-2 col-form-label">No telp</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
            </div>
          </div>
        </div>
      </div>
        <a href="/BHP/user" class="btn btn-outline-primary">
          Back
        </a>
        <button class="btn btn-outline-success col-sm-2" type="submit">
            Update Data
        </button>
      </div>
    </form>
    
</main>
</div>
</div>


@endsection