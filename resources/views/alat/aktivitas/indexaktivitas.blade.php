@extends('alat.layout.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-12 p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-7 fw-bold">Peminjaman dan Pengembalian</h1>
                    <p class="col-md-10 fs-5">Aktivitas dan pendataan pelaksanaan peminjaman dan pengembalian alat praktikum
                        Lab Telkom Barat.</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Button trigger modal -->
            <a href="javascript:void(0)" class="btn btn-primary" id="createPinjam">Pinjam</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pindai Kode Baris</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="aktivitasForm" name="aktivitasForm">
                                @csrf
                                <div class="mb-3">
                                    {{-- pindai barcode alat --}}
                                    <label for="id_mahasiswa" class="form-label">Barcode Alat</label>
                                    <input type="text"
                                        class="form-control form-control-sm mb-2 @error('barcode') is-invalid @enderror"
                                        id="barcode" name="barcode" placeholder="Barcode Alat" autofocus required
                                        value="{{ old('barcode') }}">
                                    @error('barcode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{-- nama alat --}}
                                    <label for="disabledTextInput" class="form-label">Nama Alat</label>
                                    <input type="text"
                                        class="form-control form-control-sm mb-2 @error('nama_alat') is-invalid @enderror"
                                        id="nama_alat" name="nama_alat" placeholder="Nama Alat" required readonly='true'>
                                    {{-- pindai barcode ktm --}}
                                    <label for="id_mahasiswa" class="form-label">Nomor Induk Mahasiswa</label>
                                    <input type="text"
                                        class="form-control form-control-sm mb-2 @error('id_mahasiswa') is-invalid @enderror"
                                        id="id_mahasiswa" name="id_mahasiswa" placeholder="Nomor Induk Mahasiswa" autofocus
                                        required>
                                    @error('id_mahasiswa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    {{-- nama mahasiswa --}}
                                    <label for="disabledTextInput3" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control mb-2 @error('nama_mahasiswa') is-invalid @enderror"
                                        id="nama_mahasiswa" name="nama_mahasiswa"placeholder="Nama Mahasiswa" required
                                        readonly='true'>
                                    <label for="kondisi">Kondisi</label>
                                    <select class="form-select mb-2 @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi" required value="{{ old('kondisi') }}">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak">Rusak</option>
                                        <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" disabled value="create">Input</button>
                            <button type="submit" class="btn btn-success" data-id="" id="updateBtn" value="update">Kembalikan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-lg-12 table-responsive ">
                <table class="table table-bordered table-striped" width="100%" id="aktivitas">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Alat</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
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
    <script type="text/javascript">
        $(document).ready(function() {

            $('#barcode').on('keyup change',function() {
                $.ajax({
                    url: '{{route('aktivitas.search.alat')}}',
                    data: {
                        barcode: $(this).val()
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var mahasiswa_name = $('#nama_mahasiswa').val()
                        if(data.success){
                            $('#nama_alat').val(data.msg.nama_alat)
                            $('#kondisi').val(data.msg.kondisi)
                            if(mahasiswa_name !== '' && mahasiswa_name !== 'Not Found!'){
                                $('#saveBtn').prop('disabled', false)
                            }
                        } else {
                            $('#nama_alat').val('Not Found!')
                            $('#saveBtn').prop('disabled', true)
                        }
                    }
                })
            })

            $('#id_mahasiswa').on('keyup change',function() {
                $.ajax({
                    url: '{{route('aktivitas.search.mahasiswa')}}',
                    data: {
                        id: $(this).val()
                    },
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var peralatan_name = $('#nama_alat').val()
                        if(data.success){
                            $('#nama_mahasiswa').val(data.msg.nama_mahasiswa)
                            if(peralatan_name !== '' && peralatan_name !== 'Not Found!'){
                                $('#saveBtn').prop('disabled', false)
                            }
                            $('#saveBtn').prop('disabled', false)
                        } else {
                            $('#nama_mahasiswa').val('Not Found!')
                            $('#saveBtn').prop('disabled', true)
                        }
                    }
                })
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#aktivitas').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('peminjamandanpengembalian.index') }}",
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
                        data: 'peralatan.nama_alat',
                        name: 'peralatan.nama_alat'
                    },
                    {
                        data: 'mahasiswa.nama_mahasiswa',
                        name: 'mahasiswa.nama_mahasiswa'
                    },
                    {
                        data: 'tgl_pinjam',
                        name: 'tgl_pinjam'
                    },
                    {
                        data: 'tgl_kembali',
                        name: 'tgl_kembali'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [
                    [0, 'asc']
                ]
            });
            $("#createPinjam").click(function() {
                $("#exampleModalLabel").html('Tambah Pinjam');
                $("#pinjamForm").trigger('reset');
                $("#saveBtn").show();
                $("#updateBtn").hide();
                $("#exampleModal").modal('show');
                $("#kondisi").prop('disabled', true);
                $("#barcode").attr('autofocus', 'true');
                $("#id_mahasiswa").attr('autofocus', 'true');


                $("#barcode").prop('disabled', false);
                $("#id_mahasiswa").prop('disabled', false);
                $("#kondisi").val('');
                $("#barcode").val('');
                $("#id_mahasiswa").val('');
                $("#nama_alat").val('');
                $("#nama_mahasiswa").val('');
            });

            $('#close').click(function(e) {
                $('#barcode').attr('readonly', false);
                $('#id_mahasiswa').attr('readonly', false);
            });

            $("#updateBtn").click(function(e){
                e.preventDefault();
                var urlUpdate = $(this).data("update");
                var _barcode = $('input[name="barcode"]').val();
                var _kondisi = $('select[name="kondisi"]').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: urlUpdate,
                    data: {
                        barcode: _barcode,
                        kondisi: _kondisi,
                        _token: _token,
                        _method: 'put'
                    },
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#exampleModal').modal('hide');
                        if (data.success == true) {
                            swal.fire("Done!", data.message, "success");
                        } else {
                            swal.fire("error!", data.message, "error");
                        }
                        table.draw();
                    },
                    error: function(data) {
                        $(".print-error-msg").css('display', 'block');
                        $("#error").html(data.responseJSON.errors.barcode);
                    }
                })
            })

            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html('Input');

                var _barcode = $('input[name="barcode"]').val();
                var _nama_alat = $('input[name="nama_alat"]').val();
                var _id_mahasiswa = $('input[name="id_mahasiswa"]').val();
                var _nama_mahasiswa = $('input[name="nama_mahasiswa"]').val();
                var _token = $('input[name="_token"]').val();

                console.log( $("#pinjamForm").serialize());

                $.ajax({
                    data: {
                        barcode: _barcode,
                        nama_alat: _nama_alat,
                        id_mahasiswa: _id_mahasiswa,
                        nama_mahasiswa: _nama_mahasiswa,
                        _token: _token
                    },
                    url: "{{ route('peminjamandanpengembalian.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#pinjamForm').trigger("reset");
                        $('#error').trigger("reset");
                        $('#exampleModal').modal('hide');
                        $('#barcode').attr('readonly', false);
                        $('#id_mahasiswa').attr('readonly', false);
                        if (data.success == true) {
                            swal.fire("Done!", data.message, "success");
                        } else {
                            swal.fire("error!", data.message, "error");
                        }
                        table.draw();
                    },
                    error: function(data) {
                        console.log(data);
                        $(".print-error-msg").css('display', 'block');
                        $("#error").html(data.responseJSON.errors.id_mahasiswa);
                        $("#error").html(data.responseJSON.errors.barcode);
                    }
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                if(confirm('Anda yakin ingin menghapus data ini?')){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('peminjamandanpengembalian.store') }}" + '/' + id,
                    success: function(data) {
                        if (data.success == true) {
                            swal.fire("Done!", data.message, "success");
                        } else {
                            swal.fire("error!", data.message, "error");
                        }
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error', data);
                    }
                });
            }
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                if(confirm('Anda yakin data ini sudah kembali?')){
                $.ajax({
                    type: "UPDATE",
                    url: "{{ route('peminjamandanpengembalian.store') }}" + '/' + id,
                    success: function(data) {
                        if (data.success == true) {
                            swal.fire("Done!", data.message, "success");
                        } else {
                            swal.fire("error!", data.message, "error");
                        }
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error', data);
                    }
                });
            }
            });

            $('body').on('click', '.edit', function() {
                var url = $(this).data("url");
                var update = $(this).data("update");
                $.get(url, function(data) {
                    console.log(data)
                    $("#exampleModalLabel").html('Kembalikan');
                    $('#exampleModal').modal('show');
                    $("#code39").hide();
                    $("#saveBtn").hide();
                    $("#updateBtn").show();
                    $("#kondisi").val(data.peralatan.kondisi);
                    $("#updateBtn").attr('data-update', update);
                    $("#nama_alat").val(data.peralatan.nama_alat);
                    $("#barcode").val(data.peralatan.barcode);
                    $("#nama_mahasiswa").val(data.mahasiswa.nama_mahasiswa);
                    $("#id_mahasiswa").val(data.mahasiswa.id_mahasiswa);

                    $("#barcode").prop('disabled', true);
                    $("#id_mahasiswa").prop('disabled', true);
                    $("#kondisi").prop('disabled', false);


                })
            });
        });
    </script>
@endsection
