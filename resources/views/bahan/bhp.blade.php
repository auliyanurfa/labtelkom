@extends('bahan.layout.main')


  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12 p-5 mb-4 bg-light rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data Bahan Habis Pakai</h1>
            <p class="col-md-10 fs-5">Data bahan habis pakai material praktikum Lab Telkom Barat. <h6>{{ $date }}</h6></p>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-start">
        <div class="col-sm-2">
          <a href="javascript:void(0)" class="btn btn-outline-primary mb-2" id="createBHP">Tambah BHP</a>
        </div>
        <div class="col-sm-2">
          <a href="javascript:void(0)" class="btn btn-outline-primary" id="createUnit">  
                  Tambah Jenis
          </a>
        </div>
      </div>

      <!-- Modal Unit -->
      <div class="modal fade" id="ModalUnit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
              <form id="unitForm" name="unitForm">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                    <input type="text" class="form-control form-control-sm mb-2"  id="name_unit" name="name_unit" placeholder="Nama Bahan Habis Pakai" required value="{{ old('name_unit') }}">
                    <p id= "response" style="color:red;"></p>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveBtnUnit" value="create">Input</button>
            </div>
          </div>
        </div>
      </div>


       <!-- Modal Read-->
       <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul id="error"></ul>
            </div>
              <form id="bhpForm" name="bhpForm">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="name_material" class="form-label">Nama BHP</label>
                      <input type="text" class="form-control form-control-sm mb-2 @error('name_material') is-invalid @enderror" id="name_material" name="name_material" placeholder="Nama Bahan Habis Pakai" required value="{{ old('name_material') }}">
                      
                      <label for="barcode" class="form-label">Barcode</label>
                      <input type="text" class="form-control mb-2" id="barcode" name="barcode" placeholder="Barcode" required value="{{ old('barcode') }}">
                      <svg id="code39"></svg>
  
                      <label for="spesifikasi" class="form-label">Spesifikasi</label>
                      <input type="text" class="form-control mb-2 @error('spesifikasi') is-invalid @enderror" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi" required value="{{ old('spesifikasi') }}">
                      @error('spesifikasi')
                      <div class="invalid-feedback">
                              {{ $message }}
                      </div>
                      @enderror
                      
                      <label for="Type" class="form-label">Tipe</label>
                      <input type="text" class="form-control mb-2 @error('type') is-invalid @enderror" id="type" name="type" placeholder="Type"  required value="{{ old('type') }}">
                      @error('type')
                      <div class="invalid-feedback">
                              {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="unit_id" class="form-label">Jenis</label>
                      <select class="form-select mb-2" id="unit_id" name="unit_id" required value="{{ old('unit_id') }}">
                      @foreach ($units as $unit)
                      <option value="{{ $unit->id }}">{{ $unit->name_unit }}</option>
                      @endforeach
                      </select>
  
                      <label for="stok" class="form-label">Stok</label>
                      <input type="text" class="form-control mb-2 @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Stok"  required readonly='true' value="{{ old('stok') }}">
                          @error('stok')
                      <div class="invalid-feedback">
                              {{ $message }}
                      </div>
                      @enderror
                      <label for="location" class="form-label">Lokasi</label>
                      <input type="text" class="form-control mb-2 @error('location') is-invalid @enderror" id="location" name="location" placeholder="Lokasi"  required value="{{ old('location') }}">
                      @error('location')
                      <div class="invalid-feedback">
                              {{ $message }}
                      </div>
                      @enderror
                      <label for="satuan" class="form-label">Satuan</label>
                      <select class="form-select mb-2 @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required value="{{ old('satuan') }}">
                          <option value="pcs">pcs</option>
                          <option value="liter">liter</option>
                          <option value="meter">meter</option>
                      </select>
                      @error('satuan')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
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
            <table class="table table-bordered table-striped" id="bhp" width="100%">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Material</th>
                  <th scope="col">Jenis Material</th>
                  <th scope="col">Barcode</th>
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
      var table = $('#bhp').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('dataBHP.index') }}",
      columns: [
      { "data": null,
        "class": "align-top",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'name_material', name: 'name_material' },
      { data: 'unit.name_unit', name: 'unit.name_unit' },
      { data: 'barcode', name: 'barcode'},
      { data: 'action', name: 'action' },
      ],
      order: [[0, 'asc']]
      });
      $("#createBHP").click(function(){
        $("#exampleModalLabel").html('Tambah BHP');
        $("#bhpForm").trigger('reset');
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
          data:$("#bhpForm").serialize(),
          url: "{{ route('dataBHP.store') }}",
          type: "POST",
          dataType: 'json',
        success:function(data){
            $('#bhpForm').trigger("reset");
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
            $("#error").html(data.responseJSON.errors.name_material);
            $("#error").html(data.responseJSON.errors.barcode);
            $("#error").html(data.responseJSON.errors.spesifikasi);
            $("#error").html(data.responseJSON.errors.type);
            $("#error").html(data.responseJSON.errors.stok);
            $("#error").html(data.responseJSON.errors.location);
            $("#error").html(data.responseJSON.errors.satuan);
            }
        });
      });

      $("#updateBtn").click(function(e){
        e.preventDefault();
        $(this).html('Update');
        var id = $("#id").val();  
        var data = $("#bhpForm").serialize();
        $.ajax({
          data : data,
          url: "{{route('dataBHP.index')}}"+'/'+id,
          type: "PUT",
          dataType: 'json',
        success:function(data){
            $('#bhpForm').trigger("reset");
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
            $("#error").html(data.responseJSON.errors.name_material);
            $("#error").html(data.responseJSON.errors.barcode);
            $("#error").html(data.responseJSON.errors.spesifikasi);
            $("#error").html(data.responseJSON.errors.type);
            $("#error").html(data.responseJSON.errors.stok);
            $("#error").html(data.responseJSON.errors.location);
            $("#error").html(data.responseJSON.errors.satuan);
            }
        });
      });
      $("#createUnit").click(function(){
        $("#exampleModalLabel").html('Tambah Kategori Jenis');
        $("#unitForm").trigger('reset');
        $("#ModalUnit").modal('show');
      });
      $("#saveBtnUnit").click(function(e){
        e.preventDefault();
        $(this).html('Input');
        $.ajax({
          data:$("#unitForm").serialize(),
          url: "{{ route('unit.store') }}",
          type: "POST",
          dataType: 'json',
          
          success:function(data){
            $('#unitForm').trigger("reset");
            $('#ModalUnit').modal('hide')
            if(data.success == true){
              swal.fire("Done!", data.message, "success");
            }
            setInterval('location.reload()', 1000);
          },
          error: function(data){
            $("#response").html(data.responseJSON.errors.name_unit);
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
        confirm('apakah anda yakin ingin menghapusnya ?');
        $.ajax({
            type: "DELETE",
            url : "{{ route('dataBHP.store') }}"+'/'+id,
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
      $('body').on('click', '.read', function(){
        var id = $(this).data("id");
        $.get("{{ route('dataBHP.store') }}"+'/'+id, function(data){
          $("#exampleModalLabel").html('Read BHP');
          $('#exampleModal').modal('show');
          $("#saveBtn").hide();
          $('#stok').attr('readonly', false);
          $("#updateBtn").hide();
          $("#name_material").val(data.name_material);
          $("#spesifikasi").val(data.spesifikasi);
          $("#type").val(data.type);
          $("#unit_id").val(data.unit_id);
          $("#stok").val(data.stok);
          $("#location").val(data.location);
          $("#satuan").val(data.satuan);
          $("#barcode").val(data.barcode);
          var barcode = data.barcode;
          JsBarcode("#code39", barcode,{
            format: "code39",
          });
        });
      });
      $('body').on('click', '.edit', function(){
        var id = $(this).data("id");
        $.get("{{ route('dataBHP.index') }}"+'/'+id+'/edit', function(data){
            $("#exampleModalLabel").html('Edit BHP');
            $('#exampleModal').modal('show');
            $("#code39").hide();
            $("#saveBtn").hide();
            $("#updateBtn").show();
            $('#stok').attr('readonly', true);
            $("#id").val(id);
            $("#name_material").val(data.name_material);
            $("#barcode").val(data.barcode);
            $("#spesifikasi").val(data.spesifikasi);
            $("#type").val(data.type);
            $("#unit_id").val(data.unit_id);
            $("#stok").val(data.stok);
            $("#location").val(data.location);
            $("#satuan").val(data.satuan);
        })
      });
    });
  
 </script>
@endsection

    