@extends('alat.layout.main')
@include('alat.partials.navbar')
@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="p-5 mb-4 bg-light rounded-3 col-12">
                <div class="container-fluid py-5">
                    <h1 class="display-7 fw-bold">Laporan Peminjaman</h1>
                    <p class="col-md-10 fs-5">Halaman yang berisi laporan peminjaman.</p>
                </div>
            </div>
        </div>

        {{-- <form class="d-flex col-8 mb-4">
            <button class="btn btn-outline-success col-2-mr-3 " type="submit">Export</button>

            <input class="form-control me-2 offset-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form> --}}

        <div class="container">
            <div class="col-12 table-responsive mt-1">
                <table class="table table-bordered table-striped" id="peminjaman" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Mahasiswa</th>
                            <th scope="col">Nama</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">ID Barang</th>
                            <th scope="col">Barang Dipinjam</th>
                            <th scope="col">Kondisi Awal</th>
                            <th scope="col">Waktu Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#peminjaman').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'lBfrtip',
                buttons: [
                    'excel',
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body)
                                .css('text-align', 'center')
                                .prepend(
                                    '<h3><br>Laporan Data Peminjam Peralatan Praktikum<br>Laboratorium Barat Politeknik Negeri Semarang</h3>'
                                );

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', '12px');
                        }
                    }
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('report.pinjam') }}",
                columns: [{
                        "data": null,
                        "class": "align-top",
                        "orderable": false,
                        "searchable": false,
                        "render": function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'mahasiswa.id_mahasiswa',
                        name: 'mahasiswa.id_mahasiswa'
                    },
                    {
                        data: 'mahasiswa.nama_mahasiswa',
                        name: 'mahasiswa.nama_mahasiswa'
                    },
                    {
                        data: 'mahasiswa.no_hp_mahasiswa',
                        name: 'mahasiswa.no_hp_mahasiswa'
                    },
                    {
                        data: 'peralatan.barcode',
                        name: 'peralatan.barcode'
                    },
                    {
                        data: 'peralatan.nama_alat',
                        name: 'peralatan.nama_alat'
                    },
                    {
                        data: 'kondisi_awal',
                        name: 'kondisi_awal'
                    },
                    {
                        data: 'tgl_pinjam',
                        name: 'tgl_pinjam'
                    }
                ],
                order: [
                    [3, 'desc']
                ]
            });
        });
    </script>
@endsection
