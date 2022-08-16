@extends('alat.layout.main')

@section('js')
 <script type="text/javascript">
   $(document).on('click', '.pilih_alat', function (e) {
                document.getElementById("peralatan_barcode")
                .value = $(this).attr('data-peralatan_barcode');
                document.getElementById("peralatan_id")
                .value = $(this).attr('data-peralatan_id');
                $('#myModal').modal('hide');
            });
            $(document).on('click', '.pilih_mahasiswa', function (e) {
                document.getElementById("mahasiswa_id_mahasiswa")
                .value = $(this).attr('data-mahasiswa_id_mahasiswa');
                document.getElementById("mahasiswa_nama_mahasiswa")
                .value = $(this).attr('data-mahasiswa_nama_mahasiswa');
                $('#myModal2').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });
        </script>

@stop

@section('container')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="py-3">
        <h2>Tambah Transaksi baru</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('alat/peminjamandanpengembalian') }}" method="post">
              {!! csrf_field() !!}
      
              @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
                </div>
              @endif
      
            <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                <div class="col-md-3">
                    <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" readonly>
                    @if ($errors->has('tgl_pinjam'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('tgl_pinjam') ? ' has-error' : '' }}">
                <label for="tgl_pinjam" class="col-md-4 control-label">Waktu Pinjam</label>
                <div class="col-md-3">
                    <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="{{ (Carbon\Carbon::now()->toDateTimeString()) }}" readonly>
                    @if ($errors->has('tgl_pinjam'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tgl_pinjam') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('tgl_kembali') ? ' has-error' : '' }}">
                <label for="tgl_kembali" class="col-md-4 control-label">Waktu Kembali</label>
                <div class="col-md-3">
                    <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali" value="{{ (Carbon\Carbon::now()->toDateTimeString()) }}" readonly>
                    @if ($errors->has('tgl_kembali'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tgl_kembali') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('mahasiswa_id') ? ' has-error' : '' }}">
                <label for="mahasiswa_id" class="col-md-4 control-label">Mahasiswa</label>
                <div class="col-md-6">
                    <div class="input-group">
                    <input id="mahasiswa_nama_mahasiswa" type="text" class="form-control" readonly="" required>
                    <input id="mahasiswa_id" type="hidden" name="mahasiswa_id" value="{{ old('mahasiswa_id') }}" required readonly="">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal" id="pilih_mahasiswa"><b>Cari Mahasiswa</b> <span class="fa fa-search"></span></button>
                    </span>
                    </div>
                    @if ($errors->has('mahasiswa_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mahasiswa_id') }}</strong>
                        </span>
                    @endif  
                </div>
            </div>
            <div class="mb-4 form-group{{ $errors->has('peralatan_id') ? ' has-error' : '' }}">
                <label for="peralatan_id" class="col-md-4 control-label">Peralatan</label>
                <div class="col-md-6">
                    <div class="input-group">
                    <input id="peralatan_barcode" type="text" class="form-control" readonly="" required>
                    <input id="peralatan_id" type="hidden" name="peralatan_id" value="{{ old('peralatan_id') }}" required readonly="">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal2" id="pilih_alat"><b>Cari Peralatan</b> <span class="fa fa-search"></span></button>
                    </span>
                    </div>
                    @if ($errors->has('peralatan_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('peralatan_id') }}</strong>
                        </span>
                    @endif  
                </div>
            </div>
              <div>
                <table class="flex">
                  <tr>
                    <td class="col-1"><a href="/alat/peminjamandanpengembalian" type="button" class="btn btn-outline-primary"> 
                      <i class="bi bi-arrow-left-circle"></i>  
                        Kembali
                      </a></td>
                    <td class="col-1"><button class="btn btn-outline-danger" type="reset">
                        Reset
                    </button></td>
                    <td class="col-8"><button class="btn btn-outline-success" type="submit">
                        Pinjam
                    </button></td>
                  </tr>
                </table>
              </div>
            </form>
        </div>
      </div>
       

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

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

@endsection