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
@endsection

@section('footer')
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
