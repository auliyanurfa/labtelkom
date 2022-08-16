@extends('alat.layout.main')

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="master">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="col-12 p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-7 fw-bold">Data Peralatan</h1>
          <p class="col-md-10 fs-5">Data alat praktikum Lab Telkom Barat.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div>
        <table class="mb-4 flex">
          <tr>
            <td class="col-1">
              <a type="button" class="btn btn-outline-primary" title="Tambah Mahasiswa" id="createalat">
              Tambah Alat                 
            </a></td>
          </tr>
        </table>
    </div>

    <!-- Modal Read-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Alat</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul id="error"></ul>
            </div>
              <form id="alatForm" name="alatForm">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-6">
                                          
                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('nama_alat') is-invalid @enderror" id="nama_alat" name="nama_alat" required value="{{ old('nama_alat') }}">
                        <label for="nama_alat">Nama Alat</label>
                        @error('nama_alat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('merk') is-invalid @enderror" id="merk" name="merk" required value="{{ old('merk') }}">
                        <label for="merk">Merk</label>
                        @error('merk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required value="{{ old('tipe') }}">
                        <label for="tipe">Tipe</label>
                        @error('tipe')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('tahun_masuk') is-invalid @enderror" id="tahun_masuk" name="tahun_masuk" required value="{{ old('tahun_masuk') }}">
                        <label for="tahun_masuk">Tahun Masuk</label>
                        @error('merk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>
                      
                      <div class="form-floating">
                        <input type="text" class="form-control form-control-sm mb-2 @error('barcode') is-invalid @enderror" id="barcode" name="barcode" placeholder="" required value="{{ old('barcode') }}">
                        <label for="barcode">Barcode</label>
                        @error('barcode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <svg id="code39"></svg>
                      </div>

                    </div>

                    <div class="col-md-6">

                      <div>
                        <label for="spesifikasi">Spesifikasi</label>
                        <textarea class="form-control mb-2" class="form-control form-control-sm @error('spesifikasi') is-invalid @enderror" id="spesifikasi" rows="3" name="spesifikasi" required value="{{ old('spesifikasi') }}"></textarea>
                      </div>
                      
                      <label for="jenis">Nama Jenis</label>
                      <select class="form-select mb-2" id="jenis_id" name="jenis_id" required value="{{ old('jenis_id') }}">
                      <option value="">Pilih Jenis Alat</option>
                      @foreach ($jeniss as $jenis)
                      <option value="{{ $jenis->id }}"> ({{ $jenis->kode_jenis}}) {{ $jenis->nama_jenis }} </option>
                      @endforeach
                      </select>

                      <label for="lokasi">Lokasi</label>
                      <select class="form-select mb-2" id="lokasi_id" name="lokasi_id" required value="{{ old('lokasi_id') }}">
                      <option value="">Pilih Lokasi</option>
                      @foreach ($lokasis as $lokasi)
                      <option value="{{ $lokasi->id }}"> ({{ $lokasi->kode_lokasi }}) {{ $lokasi->lab }} </option>
                      @endforeach
                      </select>

                      <label for="kondisi">Kondisi</label>
                      <select class="form-select mb-2 @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required value="{{ old('kondisi') }}">
                        <option value="">Pilih Kondisi</option>  
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                        <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                      </select>
                                          
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
    </div>

    <div class="container"> 
      <div class="col-12 table-responsive mt-1">
        <table class="table table-bordered table-striped" id="alat" width="100%">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Alat</th>
              <th scope="col">Jenis Alat</th>
              <th scope="col">Barcode</th>
              <th scope="col">Kondisi</th>
              <th scope="col">Lokasi</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</main>
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
      var table = $('#alat').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pendataanperalatan.index') }}",
      columns: [
      { "data": null,
        "class": "align-top",
        "orderable": false,
        "searchable": false,
        "render": function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        }
      },
      { data: 'nama_alat', name: 'nama_alat' },
      { data: 'jenis.nama_jenis', name: 'jenis.nama_jenis' },
      { data: 'barcode', name: 'barcode'},
      { data: 'kondisi', name: 'kondisi' },
      { data: 'lokasi.lab', name: 'lokasi.lab'},
      { data: 'action', name: 'action' },
      ],
      order: [[0, 'asc']]
      });
      $("#createalat").click(function(){
        $("#exampleModalLabel").html('Tambah Alat');
        $("#alatForm").trigger('reset');
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
          data:$("#alatForm").serialize(),
          url: "{{ route('pendataanperalatan.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(data){
            $('#alatForm').trigger("reset");
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
            $("#error").html(data.responseJSON.errors.nama_alat);
            $("#error").html(data.responseJSON.errors.barcode);
            $("#error").html(data.responseJSON.errors.tipe);
            $("#error").html(data.responseJSON.errors.merk);
            $("#error").html(data.responseJSON.errors.tahun_masuk);
            $("#error").html(data.responseJSON.errors.kondisi);
            }
        });
      });

      $("#updateBtn").click(function(e){
        e.preventDefault();
        $(this).html('Update');
        var id = $("#id").val();  
        var data = $("#alatForm").serialize();
        $.ajax({
          data : data,
          url: "{{route('pendataanperalatan.index')}}"+'/'+id,
          type: "PUT",
          dataType: 'json',
          success:function(data){
            $('#alatForm').trigger("reset");
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
            url : "{{ route('pendataanperalatan.store') }}"+'/'+id,
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
        $.get("{{ route('pendataanperalatan.store') }}"+'/'+id, function(data){
          $("#exampleModalLabel").html('Detail Alat');
          $('#exampleModal').modal('show');
          $("#saveBtn").hide();
          $("#updateBtn").hide();
          $("#nama_alat").val(data.nama_alat);
          $("#merk").val(data.merk);
          $("#tipe").val(data.tipe);
          $("#id_jenis").val(data.id_jenis);
          $("#spesifikasi").val(data.spesifikasi);
          $("#id_lokasi").val(data.id_lokasi);
          $("#tahun_masuk").val(data.tahun_masuk);
          $("#kondisi").val(data.kondisi);
          $("#barcode").val(data.barcode);
          var barcode = data.barcode;
          JsBarcode("#code39", barcode,{
            format: "code39",
          });
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
          $("#merk").val(data.merk);
          $("#tipe").val(data.tipe);
          $("#id_jenis").val(data.id_jenis);
          $("#spesifikasi").val(data.spesifikasi);
          $("#id_lokasi").val(data.id_lokasi);
          $("#tahun_masuk").val(data.tahun_masuk);
          $("#kondisi").val(data.kondisi);
          $("#barcode").val(data.barcode);
        })
      });
  });

 </script>
@endsection
