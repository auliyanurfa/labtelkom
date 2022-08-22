@extends('bahan.layout.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-7 fw-bold">Aktivitas Pengeluaran</h1>
                    <p class="col-md-10 fs-5">Halaman yang berisi mengenai aktivitas admin untuk melakukan pengeluaran atau
                        output barang material praktikum di Laboratorium Barat.
                    <h6>{{ $date }}</p>
                </div>
            </div>
        </div>

        <form class="d-flex mx-auto col-5">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <div class="card-body">
            <!-- Button trigger modal -->
            <a href="javascript:void(0)" class="btn btn-primary" id="createPengeluaran">Scan</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Scan Barcode</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="pengeluaranForm" name="pengeluaranForm">
                                @csrf
                                <div class="mb-3">
                                    {{-- scan barcode --}}
                                    <input type="text" class="form-control" id="barcode" placeholder="Barcode"
                                        name="barcode">
                                    {{-- nama bhp --}}
                                    <label for="disabledTextInput" class="form-label"></label>
                                    <input type="text" class="form-control" id="name_material"
                                        name="name_material"placeholder="Nama Material" readonly='true'>
                                    {{-- stok awal --}}
                                    <label for="disabledTextInput2" class="form-label"></label>
                                    <input type="text" class="form-control" id="stok" name="stok"
                                        placeholder="Sisa Stok" readonly='true'>
                                    {{-- stok keluar --}}
                                    <label for="Stok" class="form-label"></label>
                                    <input type="text" class="form-control" id="stok_keluar"
                                        name="stok_keluar"placeholder="Stok Keluar">
                                    {{-- satuan --}}
                                    <label for="satuan" class="form-label"></label>
                                    <input type="text" class="form-control" id="satuan"
                                        name="satuan"placeholder="Satuan" readonly='true'>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="close">Close</button>

                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Input</button>

                        </div>
                    </div>
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
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
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
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body)
                                .css('text-align', 'center')
                                .prepend(
                                    '<h3>Laporan Aktivitas BHP Lab Barat Politeknik Negeri Semarang</h3>'
                                );

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', '12px');
                        }
                    }

                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('aktivitaspengeluaran.index') }}",
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
                        data: 'name_material',
                        name: 'name_material'
                    },
                    {
                        data: 'barcode',
                        name: 'barcode'
                    },
                    {
                        data: 'stok_awal',
                        name: 'stok_awal'
                    },
                    {
                        data: 'stok_keluar',
                        name: 'stok_keluar'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
                order: [
                    [7, 'dsc']
                ]
            });
            $("#createPengeluaran").click(function() {
                $('#pengeluaranForm').trigger("reset");
                $('#exampleModal').modal('show');
            });

            $("#barcode").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ url('/BHP/aktivitaspengeluaran/create') }}",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function(data) {
                            var resp = $.map(data, function(obj) {
                                console.log(obj);
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

            $('#close').click(function(e) {
                $('#barcode').attr('readonly', false);
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html('Input');

                $.ajax({
                    data: $("#pengeluaranForm").serialize(),
                    url: "{{ route('aktivitaspengeluaran.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#pengeluaranForm').trigger("reset");
                        $('#exampleModal').modal('hide');
                        $('#barcode').attr('readonly', false);
                        if (data.success == true) {
                            swal.fire("Done!", data.message, "success");
                        } else {
                            swal.fire("Error!", data.message, "error");
                        }
                        table.draw();
                    }
                });
            });
        });
    </script>
@endsection
