@extends('alat.layout.main')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="col-12 p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-7 fw-bold">Data Jenis Alat</h1>
          <p class="col-md-10 fs-5">Data jenis alat praktikum Laboratorium Telkom Barat.</p>
        </div>
      </div>
    </div>

      <div class="row">
        <div>
          <table class="mb-4">
            <tr>
              <td class="col-1 mb-3"><a type="button" class="btn btn-outline-primary" title="Tambah Jenis" id="createjenis">  
                <i aria-hidden="true"></i> Tambah Jenis                 
              </a></td>
            </tr>
          </table>
      </div>  
    
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul id="error"></ul>
            </div>
              <form id="jenisForm" name="jenisForm">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <div class="row">
                    <div>
                      
                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('nama_jenis') is-invalid @enderror" id="nama_jenis" name="nama_jenis" required value="{{ old('nama_jenis') }}">
                        <label for="nama_jenis">Nama Jenis</label>
                        @error('nama_jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>                              

                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('kode_jenis') is-invalid @enderror" id="kode_jenis" name="kode_jenis" required value="{{ old('kode_jenis') }}">
                        <label for="kode_jenis">Kode Jenis</label>
                        @error('kode_jenis')
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
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Input</button>
              <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
            </div>
          </div>
        </div>
      </div>
      <div class="container"> 
          <div class="col-12 table-responsive mt-1">
            <table class="table table-bordered table-striped" id="jenis" width="100%">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Jenis</th>
                  <th scope="col">Kode Jenis</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
    </main>
  </div>
</div>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
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
      var table = $('#jenis').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pendataanjenis.index') }}",
      columns: [
      { "data": null,
        "class": "align-top",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'nama_jenis', name: 'nama_jenis' },
      { data: 'kode_jenis', name: 'kode_jenis' },
      { data: 'action', name: 'action' },
      ],
      order: [[0, 'asc']]
      });
      $("#createjenis").click(function(){
        $("#exampleModalLabel").html('Tambah Jenis');
        $("#alatForm").trigger('reset');
        $("#exampleModal").modal('show');
        $("#updateBtn").hide();
        $('.print-error-msg').hide();
        $("#saveBtn").show();
      });
      $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Input');
        
        $.ajax({
          data:$("#jenisForm").serialize(),
          url: "{{ route('pendataanjenis.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(data){
            $('#jenisForm').trigger("reset");
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
            $("#error").html(data.responseJSON.errors.nama_jenis);
            $("#error").html(data.responseJSON.errors.kode_jenis)
            }
        });
      });

      $("#updateBtn").click(function(e){
        e.preventDefault();
        $(this).html('Update');
        var id = $("#id").val();  
        var data = $("#jenisForm").serialize();
        $.ajax({
          data : data,
          url: "{{route('pendataanjenis.index')}}"+'/'+id,
          type: "PUT",
          dataType: 'json',
        success:function(data){
            $('#jenisForm').trigger("reset");
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
    
      $('body').on('click', '.delete', function(){
        var id = $(this).data("id");
        confirm('Apakah anda yakin ingin menghapus data ini?');
        $.ajax({
            type: "DELETE",
            url : "{{ route('pendataanjenis.store') }}"+'/'+id,
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
        $.get("{{ route('pendataanjenis.index') }}"+'/'+id+'/edit', function(data){
          $("#exampleModalLabel").html('Ubah Jenis');
          $('#exampleModal').modal('show');
          $("#saveBtn").hide();
          $("#updateBtn").show();
          $("#id").val(id);
          $("#nama_jenis").val(data.nama_jenis);
          $("#kode_jenis").val(data.kode_jenis);
        })
    });
  });

 </script>
@endsection

