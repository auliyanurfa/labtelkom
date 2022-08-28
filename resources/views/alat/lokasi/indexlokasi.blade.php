@extends('alat.layout.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-12 p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-7 fw-bold">Data Lokasi Alat</h1>
                    <p class="col-md-10 fs-5">Data lokasi penempatan alat praktikum Laboratorium Telkom Barat.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div>
                <table class="mb-4">
                    <tr>
                        <td class="col-1 mb-3"><a type="button" class="btn btn-outline-primary" title="Tambah Lokasi"
                                id="createlokasi">
                                <i aria-hidden="true"></i> Tambah Lokasi
                            </a></td>
                    </tr>
                </table>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul id="error"></ul>
                            </div>
                            <form id="lokasiForm" name="lokasiForm">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="mb-3">
                                    <div class="row">
                                        <div>

                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control form-control-sm mb-2 @error('lab') is-invalid @enderror"
                                                    id="lab" name="lab" required value="{{ old('lab') }}">
                                                <label for="lab">Laboratorium</label>
                                                @error('lab')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control form-control-sm mb-2 @error('almari') is-invalid @enderror"
                                                    id="almari" name="almari" required value="{{ old('almari') }}">
                                                <label for="almari">Almari</label>
                                                @error('almari')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-floating">
                                                <input type="text"
                                                    class="form-control form-control-sm mb-2 @error('kode_lokasi') is-invalid @enderror"
                                                    id="kode_lokasi" name="kode_lokasi" required
                                                    value="{{ old('kode_lokasi') }}">
                                                <label for="kode_lokasi">Kode Lokasi</label>
                                                @error('kode_lokasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

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
            <div class="container">
                <div class="col-12 table-responsive mt-1">
                    <table class="table table-bordered table-striped" id="lokasi" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Laboratorium</th>
                                <th scope="col">Almari</th>
                                <th scope="col">Kode Lokasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#lokasi').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pendataanlokasi.index') }}",
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
                        data: 'lab',
                        name: 'lab'
                    },
                    {
                        data: 'almari',
                        name: 'almari'
                    },
                    {
                        data: 'kode_lokasi',
                        name: 'kode_lokasi'
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
            $("#createlokasi").click(function() {
                $("#exampleModalLabel").html('Tambah Lokasi');
                $("#lokasiForm").trigger('reset');
                $("#exampleModal").modal('show');
                $("#updateBtn").hide();
                $('.print-error-msg').hide();
                $("#saveBtn").show();
            });
            $("#saveBtn").click(function(e) {
                e.preventDefault();
                $(this).html('Input');

                $.ajax({
                    data: $("#lokasiForm").serialize(),
                    url: "{{ route('pendataanlokasi.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#lokasiForm').trigger("reset");
                        $('#error').trigger("reset");
                        $('#exampleModal').modal('hide');
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
                        $("#error").html(data.responseJSON.errors.lab);
                        $("#error").html(data.responseJSON.errors.almari);
                        $("#error").html(data.responseJSON.errors.kode_lokasi)
                    }
                });
            });

            $("#updateBtn").click(function(e) {
                e.preventDefault();
                $(this).html('Update');
                var id = $("#id").val();
                var data = $("#lokasiForm").serialize();
                console.log('blok', data)
                $.ajax({
                    data: data,
                    url: "{{ route('pendataanlokasi.index') }}" + '/' + id,
                    type: "PUT",
                    dataType: 'json',
                    success: function(data) {
                        $('#lokasiForm').trigger("reset");
                        $('#exampleModal').modal('hide');
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
                        $("#error").html(data.responseJSON.errors.lab);
                        $("#error").html(data.responseJSON.errors.almari);
                        $("#error").html(data.responseJSON.errors.kode_lokasi)
                    }
                });
            });

            $('body').on('click', '.delete', function() {
                var id = $(this).data("id");
                if(confirm('Apakah anda yakin ingin menghapus data ini?')){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('pendataanlokasi.store') }}" + '/' + id,
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
                var id = $(this).data("id");
                $.get("{{ route('pendataanlokasi.index') }}" + '/' + id + '/edit', function(data) {
                    $("#exampleModalLabel").html('Ubah Lokasi');
                    $('#exampleModal').modal('show');
                    $("#saveBtn").hide();
                    $("#updateBtn").show();
                    $("#id").val(id);
                    $("#lab").val(data.lab);
                    $("#almari").val(data.almari);
                    $("#kode_lokasi").val(data.kode_lokasi);
                })
            });
        });
    </script>
@endsection
