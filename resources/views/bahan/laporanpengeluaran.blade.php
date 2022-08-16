@extends('bahan.layout.main')

  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3 col-12">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Laporan Pengeluaran</h1>
            <p class="col-md-10 fs-5">Halaman yang berisi laporan pengeluaran.<h6>{{ $date }}</p>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
        <div class="col-lg-12 table-responsive">
          <table class="table table-bordered table-striped" width="100%" id="pengeluaran">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama BHP</th>
                <th scope="col">Barcode</th>
                <th scope="col">Stok Awal</th>
                <th scope="col">Stok Keluar</th>
                <th scope="col">Total Stok</th>
                <th scope="col">Satuan</th>
                <th scope="col">Tanggal Pengeluaran</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            </div>
        </table>
      </div>
    </main>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"referrerpolicy="no-referrer"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    
    {{-- button --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js   "></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
      $(document).ready( function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        var table = $('#pengeluaran').DataTable({
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"],
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
        ajax: "{{ route('aktivitaspengeluaran.index') }}",
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
        { data: 'stok_keluar', name: 'stok_keluar' },
        { data: 'stok', name: 'stok' },
        { data: 'satuan', name: 'satuan' },
        { data: 'created_at', name: 'created_at' },
        ],
        order: [[7, 'dsc']]
        });
      });
    </script>
@endsection

    