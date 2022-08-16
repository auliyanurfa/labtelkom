@extends('alat.layout.main')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div class="col-12 p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-7 fw-bold">Peminjaman dan Pengembalian</h1>
        <p class="col-md-10 fs-5">Aktivitas dan pendataan pelaksanaan peminjaman dan pengembalian alat praktikum Lab Telkom Barat.</p>
      </div>
    </div>
  </div>
    
  <div class="card-body">
    <!-- Button trigger modal -->
    <a href="javascript:void(0)" class="btn btn-primary" id="createPinjam">Pinjam</a>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pindai Kode Baris</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="aktivitasForm" name="aktivitasForm">
              @csrf
              <div class="mb-3">
                {{-- pindai barcode alat --}}
                  <label for="id_mahasiswa" class="form-label">Barcode Alat</label>
                  <input type="text" class="form-control form-control-sm mb-2 @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="Barcode Alat" autofocus required value="{{ old('barcode') }}">
                  @error('barcode')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
                {{-- nama alat --}}
                  <label for="disabledTextInput" class="form-label">Nama Alat</label>
                  <input type="text" class="form-control form-control-sm mb-2 @error('nama_alat') is-invalid @enderror" id="nama_alat" name="nama_alat" placeholder="Nama Alat" required readonly='true'>
                {{-- pindai barcode ktm --}}
                  <label for="id_mahasiswa" class="form-label">Nomor Induk Mahasiswa</label>
                  <input type="text" class="form-control form-control-sm mb-2 @error('id_mahasiswa') is-invalid @enderror" id="id_mahasiswa" name="id_mahasiswa" placeholder="Nomor Induk Mahasiswa" autofocus required>
                  @error('id_mahasiswa')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                {{-- nama mahasiswa --}}  
                  <label for="disabledTextInput3" class="form-label">Nama Mahasiswa</label>
                  <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" id="nama_mahasiswa" name="nama_mahasiswa"placeholder="Nama Mahasiswa" required readonly='true'> 
              </div>
            </form> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Input</button>
          </div>
        </div>
      </div>
    </div>
</div>
  <div class="container">
    <div class="col-lg-12 table-responsive ">
        <table class="table table-bordered table-striped" width="100%" id="aktivitas">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Alat</th>
              <th scope="col">Nama Mahasiswa</th>
              <th scope="col">Tanggal Pinjam</th>
              <th scope="col">Tanggal Kembali</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          </div>
      </table>
    </div>
  </div>
</main>

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"referrerpolicy="no-referrer"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

{{-- button --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var table = $('#aktivitas').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('peminjamandanpengembalian.index') }}",
      columns: [
      { "data": null,
        "class": "align-top",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'mahasiswa.nama_mahasiswa', name: 'mahasiswa.nama_mahasiswa' },
      { data: 'peralatan.nama_alat', name: 'peralatan.nama_alat' },
      { data: 'created_at', name: 'created_at'},
      { data: 'updated_at', name: 'updated_at'},
      { data: 'status', name: 'status' },
      ],
      order: [[0, 'asc']]
      });
      $("#createPinjam").click(function(){
        $("#exampleModalLabel").html('Tambah Pinjam');
        $("#pinjamForm").trigger('reset');
        $("#exampleModal").modal('show');
        $("#barcode").attr('autofocus', 'true');
        $("#id_mahasiswa").attr('autofocus', 'true');
      });

      $( "#barcode" ).autocomplete({
       source: function(request, response) {
         $.ajax({
           url: "{{ url('/alat/peminjamandanpengembalian/create') }}",
           data: {
             term1 : request.term
            },
            dataType: "json",
            success: function(data){
              var resp = $.map(data,function(obj){
                $('#nama_alat').val(obj.nama_alat);
                $('#barcode').attr('readonly', true);
                }); 
                response(resp);
             }
         });
        },
        minLength: 2 
      });

      $( "#id_mahasiswa" ).autocomplete({
       source: function(request, response) {
         $.ajax({
           url: "{{ url('/alat/peminjamandanpengembalian/create') }}",
           data: {
             term2 : request.term
            },
            dataType: "json",
            success: function(data){
              var resp = $.map(data,function(obj){
                $('#nama_mahasiswa').val(obj.nama_mahasiswa);
                $('#id_mahasiswa').attr('readonly', true);
                }); 
                response(resp);
             }
         });
        },
        minLength: 2 
      });

      $('#close').click(function(e){
          $('#barcode').attr('readonly', false);
          $('#id_mahasiswa').attr('readonly', false);
      });

      $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Input');
        
        $.ajax({
          data:$("#pinjamForm").serialize(),
          url: "{{ route('peminjamandanpengembalian.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(data){
            $('#pinjamForm').trigger("reset");
            $('#error').trigger("reset");
            $('#exampleModal').modal('hide');
            $('#barcode').attr('readonly', false);
            $('#id_mahasiswa').attr('readonly', false);
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
            $("#error").html(data.responseJSON.errors.barcode);
            }
        });
      });

      $('body').on('click', '.delete', function(){
        var id = $(this).data("id");
        confirm('Anda yakin ingin menghapus data ini?');
        $.ajax({
            type: "DELETE",
            url : "{{ route('peminjamandanpengembalian.store') }}"+'/'+id,
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
      
      $('body').on('click', '.delete', function(){
        var id = $(this).data("id");
        confirm('Anda yakin data ini sudah kembali?');
        $.ajax({
            type: "UPDATE",
            url : "{{ route('peminjamandanpengembalian.store') }}"+'/'+id,
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
        $.get("{{ route('pendataanperalatan.index') }}"+'/'+id+'/edit', function(data){
          $("#exampleModalLabel").html('Ubah Alat');
          $('#exampleModal').modal('show');
          $("#code39").hide();
          $("#saveBtn").hide();
          $("#updateBtn").show();
          $("#id").val(id);
          $("#nama_alat").val(data.nama_alat);
          $("#id_lokasi").val(data.id_lokasi);
          $("#barcode").val(data.barcode);
        })
      });
  });

 </script>
@endsection