@extends('bahan.layout.main')

  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="master">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Aktivitas Pemasukan</h1>
            <p class="col-md-10 fs-5">Halaman yang berisi mengenai aktivitas admin untuk melakukan pemasukan atau input barang material praktikum di Laboratorium Barat. <h6>{{ $date }}</h6></p>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Button trigger modal -->
        <a href="javascript:void(0)" class="btn btn-primary" id="createPemasukan">Scan</a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Scan Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="pemasukanForm" name="pemasukanForm">
                  @csrf
                  <div class="mb-3">
                    {{-- scan barcode --}}
                      <input type="text" class="form-control" id="barcode" placeholder="Barcode" name="barcode" autofocus required>
                    {{-- nama bhp --}}
                      <label for="disabledTextInput" class="form-label"></label>
                      <input type="text" class="form-control @error('name_material') is-invalid @enderror" id="name_material" name="name_material"placeholder="Nama Material" required readonly='true'>
                    {{-- stok awal --}}
                      <label for="disabledTextInput2" class="form-label"></label>
                      <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" placeholder="Sisa Stok" required readonly='true'>
                    {{-- stok masuk --}}
                      <label for="Stok" class="form-label"></label>
                      <input type="text" class="form-control @error('stok_masuk') is-invalid @enderror" id="stok_masuk" name="stok_masuk"placeholder="Stok Masuk" required>
                    {{-- satuan --}}
                      <label for="Stok" class="form-label"></label>
                      <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan"placeholder="satuan" required readonly='true'>

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
            <table class="table table-bordered table-striped" width="100%" id="pemasukan">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama BHP</th>
                  <th scope="col">Barcode</th>
                  <th scope="col">Stok Awal</th>
                  <th scope="col">Stok Masuk</th>
                  <th scope="col">Total Stok</th>
                  <th scope="col">Satuan</th>
                  <th scope="col">Tanggal Pemasukan</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              </div>
          </table>
        </div>
      </div>
    </main>
@endsection
@section('footer')
    <script>
    $(document).ready( function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var table = $('#pemasukan').DataTable({
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      dom: 'lBfrtip',
            buttons: [
            'excel',
          { extend: 'print',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'text-align', 'center' )
                        .prepend(
                            '<h3>Laporan Aktivitas BHP Lab Barat Politeknik Negeri Semarang</h3>'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', '12px');
                }
              }
           ],
      processing: true,
      serverSide: true,
      ajax: "{{ route('aktivitaspemasukan.index') }}",
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
      { data: 'barcode', name: 'barcode' },
      { data: 'stok_awal', name: 'stok_awal' },
      { data: 'stok_masuk', name: 'stok_masuk' },
      { data: 'stok', name: 'stok' },
      { data: 'satuan', name: 'satuan' },
      { data: 'created_at', name: 'created_at' },
      ],
      order: [[7, 'desc']]
      });
      $("#createPemasukan").click(function(){
        $('#pemasukanForm').trigger("reset");
        $('#exampleModal').modal('show');
        $("#barcode").attr('autofocus', 'true');
      });

      $( "#barcode" ).autocomplete({
       source: function(request, response) {
         $.ajax({
           url: "{{ url('/BHP/aktivitaspemasukan/create') }}",
           data: {
             term : request.term
            },
            dataType: "json",
            success: function(data){
              var resp = $.map(data,function(obj){
                $('#name_material').val(obj.name_material);
                $('#stok').val(obj.stok);
                $('#satuan').val(obj.satuan);
                $('#barcode').attr('readonly', true);
                });
                response(resp);
             }
         });
        },
        minLength: 2
      });
        $('#close').click(function(e){
          $('#barcode').attr('readonly', false);
        });
      $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('Input');

        $.ajax({
          data:$("#pemasukanForm").serialize(),
          url: "{{ route('aktivitaspemasukan.store') }}",
          type: "POST",
          dataType: 'json',
          success:function(data){
            $('#pemasukanForm').trigger("reset");
            $('#exampleModal').modal('hide');
            $('#barcode').attr('readonly', false);
            if(data.success == true){
              swal.fire("Done!", data.message, "success");
            } else{
              swal.fire("Error!", data.message, "error");
            }
            table.draw();
          }
        });
      });
    });

 </script>
@endsection

