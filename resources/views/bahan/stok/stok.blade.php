@extends('bahan.layout.main')


  @section('container')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="col-12 p-5 mb-4 bg-light rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-7 fw-bold">Data Stok Bahan Habis Pakai</h1>
            <p class="col-md-10 fs-5">Data stok bahan habis pakai praktikum Lab Telkom Barat.<h6>{{ $date }}</h6></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 mb-1">
          <a href="/BHP/stok/cetak" class="btn btn-outline-info" target="_blank">Export PDF</a>
        </div>
        <div class="col-sm-10">
          <form action="/BHP/stok" class="d-flex mx-0 col-7 mb-4">
            <input class="form-control me-2" type="text" placeholder="Search by Name / Type" aria-label="Search" name="search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
      <div class="container"> 
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Material</th>
                  <th scope="col">Barcode</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Satuan</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
                @foreach($materials as $material)
                <tr>
                  <th><?= $i; ?></th>
                  <td>{{ $material["name_material"] }}</td>
                  <td>{!! DNS1D::getBarcodeSVG($material->barcode, "C39") !!}</td>
                  <td>{{ $material["stok"] }}</td>
                  <td>{{ $material["satuan"] }}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
            {{ $materials->links() }}
          </div>
        </div>
    </main>
  </div>
</div>


@endsection

    