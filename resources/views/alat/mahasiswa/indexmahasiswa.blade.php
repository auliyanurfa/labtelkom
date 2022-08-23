@extends('alat.layout.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-12 p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-7 fw-bold">Data Mahasiswa</h1>
                    <p class="col-md-10 fs-5">Data mahasiswa peminjam alat praktikum Lab Telkom Barat.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div>
              <table class="mb-4 flex">
                <tr>
                  <td class="col-1">
                    <a type="button" class="btn btn-outline-primary" title="Tambah Mahasiswa" id="createmahasiswa">
                    Tambah Mahasiswa
                  </a></td>
                </tr>
              </table>
          </div>

      <!-- Modal Read-->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul id="error"></ul>
              </div>
                <form id="mahasiswaForm" name="mahasiswaForm">
                  @csrf
                  <input type="hidden" name="id" id="id">
                  <div class="mb-3">
                    <div class="row">
                      <div>

                        <div class="form-floating">
                          <input type="text" class="form-control form-control-sm mb-2 @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa" required value="{{ old('id_mahasiswa') }}">
                          <label for="id_mahasiswa">Nomor Induk Mahasiswa</label>
                          @error('id_mahasiswa')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>

                        <div class="form-floating">
                          <input type="text" class="form-control form-control-sm mb-2 @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa" required value="{{ old('nama_mahasiswa') }}">
                          <label for="nama_mahasiswa">Nama Mahasiswa</label>
                          @error('nama_mahasiswa')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>

                        <div class="form-floating">
                          <input type="text" class="form-control form-control-sm mb-2 @error('no_hp_mahasiswa') is-invalid @enderror" id="no_hp_mahasiswa" name="no_hp_mahasiswa" required value="{{ old('no_hp_mahasiswa') }}">
                          <label for="no_hp_mahasiswa">Nomor HP Mahasiswa</label>
                          @error('no_hp_mahasiswa')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                          @enderror
                        </div>

                      </div>
                    </div>

                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Tambah</button>
                <button type="submit" class="btn btn-primary" id="updateBtn">Ubah</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="col-12 table-responsive mt-1">
          <table class="table table-bordered table-striped" id="mahasiswa" width="100%">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nomor Induk Mahasiswa</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">Nomor HP Mahasiswa</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready( function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var table = $('#mahasiswa').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pendataanmahasiswa.index') }}",
      columns: [
      { "data": null,
        "class": "align-top",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'id_mahasiswa', name: 'id_mahasiswa' },
      { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
      { data: 'no_hp_mahasiswa', name: 'no_hp_mahasiswa' },
      { data: 'action', name: 'action' },
      ],
      order: [[0, 'asc']]
      });
      $("#createmahasiswa").click(function(){
        $("#exampleModalLabel").html('Tambah Mahasiswa');
        $("#mahasiswaForm").trigger('reset');
        $("#exampleModal").modal('show');
        $("#code39").hide();
        $("#updateBtn").hide();
        $('.print-error-msg').hide();
        $("#saveBtn").show();
      });
      $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Input');

        $.ajax({
          data:$("#mahasiswaForm").serialize(),
          url: "{{ route('pendataanmahasiswa.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(data){
            $('#mahasiswaForm').trigger("reset");
            $('#error').trigger("reset");
            $('#exampleModal').modal('hide');
            if(data.success == true){
              swal.fire("Done!", data.message, "success");
            } else{
              swal.fire("error!", data.message, "error");
            }
            table.draw();
          },
          error: function(data){
            console.log(data);
            $(".print-error-msg").css('display','block');
            $("#error").html(data.responseJSON.errors.id_mahasiswa);
            $("#error").html(data.responseJSON.errors.nama_mahasiswa);
            $("#error").html(data.responseJSON.errors.no_hp_mahasiswa);
            }
        });
      });

      $("#updateBtn").click(function(e){
        e.preventDefault();
        $(this).html('Update');
        var id = $("#id").val();
        var data = $("#mahasiswaForm").serialize();
        $.ajax({
          data : data,
          url: "{{route('pendataanmahasiswa.index')}}"+'/'+id,
          type: "PUT",
          dataType: 'json',
          success:function(data){
            $('#mahasiswaForm').trigger("reset");
            $('#exampleModal').modal('hide');
            if(data.success == true){
              swal.fire("Done!", data.message, "success");
            } else{
              swal.fire("error!", data.message, "error");
            }
            table.draw();
          }
        });
      });

      function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
      }

      $('body').on('click', '.delete', function(){
        var id = $(this).data("id");
        confirm('Anda yakin ingin menghapus data ini?');
        $.ajax({
            type: "DELETE",
            url : "{{ route('pendataanmahasiswa.store') }}"+'/'+id,
            success:function(data){
              if(data.success == true){
              swal.fire("Done!", data.message, "success");
              } else{
              swal.fire("error!", data.message, "error");
              }
                table.draw();
            },
            error: function(data){
                console.log('Error',data);
            }
        });
      });

      $('body').on('click', '.edit', function(){
        var id = $(this).data("id");
        $.get("{{ route('pendataanmahasiswa.index') }}"+'/'+id+'/edit', function(data){
          $("#exampleModalLabel").html('Ubah Mahasiswa');
          $('#exampleModal').modal('show');
          $("#saveBtn").hide();
          $("#updateBtn").show();
          $("#id").val(id);
          $("#id_mahasiswa").val(data.id_mahasiswa);
          $("#nama_mahasiswa").val(data.nama_mahasiswa);
          $("#no_hp_mahasiswa").val(data.no_hp_mahasiswa);
        })
      });
  });

  </script>
  @endsection
