@extends('alat.layout.main')

  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="master">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="p-5 mb-4 bg-light rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data Peralatan</h1>
            <p class="col-md-10 fs-5">Rekap pendataan peralatan penunjang pelaksanaan praktikum Program Studi Teknik Telekomunikasi yang ada di Laboratorium Telekomunikasi<h6>{{ $date }}</h6></p>
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
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </main>

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"referrerpolicy="no-referrer"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="sorttable.js"></script>

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

    <script>
    $(document).ready( function () {
      $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var table = $('#alat').DataTable({
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
                            '<h3>Laporan Data Peralatan Lab Barat Politeknik Negeri Semarang</h3>'
                        );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', '12px');
                }
              }
           ],
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
      ],
      order: [[3, 'desc']]
      });
    });
  
 </script> 
@endsection

    