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

      <form class="d-flex col-8 mb-4">
       <button class="btn btn-outline-success col-2-mr-3 " type="submit">Export</button>

       <input class="form-control me-2 offset-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <div class="container">
          <div class="col-12">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">ID Mahasiswa</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">ID Barang</th>
                  <th scope="col">Barang Dipinjam</th>
                  <th scope="col">Kondisi Awal</th>
                  <th scope="col">Waktu Dipinjam</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>12adcb</td>
                  <td>Kelas TE4B</td>
                  <td>Kevin</td>
                  <td>blablabla</td>
                  <td>Tipe</td>
                  <td>20</td>
                  <td>100</td>
                </tr>
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
    </main>
  </div>
</div>
@endsection

    