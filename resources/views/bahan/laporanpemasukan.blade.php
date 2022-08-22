@extends('bahan.layout.main')

  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3 col-12">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Laporan Pemasukan</h1>
            <p class="col-md-10 fs-5">Halaman yang berisi laporan pemasukan.<h6>{{ $date }}</p>
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
                          .css( 'text-align', 'center' );
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
      });
    </script>
@endsection

