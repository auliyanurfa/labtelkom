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

      <div class="container">
    <div class="col-12 table-responsive mt-1">
      <table class="table table-bordered table-striped" id="mahasiswa" width="100%">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nomor Induk Mahasiswa</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Nomor HP Mahasiswa</th>
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
      var table = $('#mahasiswa').DataTable({
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
                            '<h3><br>Laporan Data Mahasiswa Peminjam Peralatan Praktikum<br>Laboratorium Barat Politeknik Negeri Semarang</h3>'
                        );

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', '12px');
                }
              }
           ],
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
      ],
      order: [[3, 'desc']]
      });
    });

    </script>
    @endsection

