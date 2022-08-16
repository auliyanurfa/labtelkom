@extends('bahan.layout.main')

  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3 col-12">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data Seluruh User</h1>
            <p class="col-md-10 fs-5">Halaman yang berisi informasi data seluruh user.<h6>{{ $date }}</h6></p>
          </div>
        </div>
      </div>
        <div class="container">
        <div class="row">

          @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

          <div class="col-12  table-responsive">      
            <a href="/BHP/user/create" type="button" class="btn btn-outline-primary mb-3">  
              Add User
            </a>
            <br>
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Username</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr>
                  <th >{{ $loop->iteration }}</th>
                  <td>{{ $user["name"] }}</td>
                  <td>{{ $user["username"] }}</td>
                  <td>{{ $user->role->role_name }}</td>
                  <td>
                  <a href="/BHP/user/{{ $user->id }}" class="btn btn-success">Detail</a>
                  <a href="/BHP/user/{{ $user->id }}/edit" class="btn btn-warning">
                      Edit                    
                  </a> 
                  <form action="/BHP/user/{{ $user->id }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                  <button onclick="return confirm('are you sure ?')" class="btn btn-danger">Delete</button>
                  </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
      </div>
    </main>
@endsection

    