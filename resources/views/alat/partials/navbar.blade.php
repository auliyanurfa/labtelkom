<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          @if(auth()->user()->role_id==1)
          <li class="nav-item">
            <a class="nav-link {{($title === "Index") ? 'active' : '' }}" aria-current="page" href="/">
              </span>
              <i class="bi bi-house"></i>
               Menu Utama
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Dashboard") ? 'active' : '' }}" aria-current="page" href="/alat/dashboard">
              </span>
              <i class="bi bi-pie-chart"></i>
              Dashboard
            </a>
          </li>
            <div class="container-fluid border border-3 rounded mb-2">
              <span class="navbar-text">
              <i class="bi bi-clipboard-minus"></i>
              Pendataan
              </span>
            <li class="nav-item">
                <a class="nav-link {{($title === "Peralatan") ? 'active' : '' }}" href="/alat/pendataanperalatan">
                  <i class="bi bi-tools"></i>
                  Peralatan
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Mahasiswa") ? 'active' : '' }}" href="/alat/pendataanmahasiswa">
                <i class="bi bi-people"></i>
                  Mahasiswa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Jenis Alat") ? 'active' : '' }}" href="/alat/pendataanjenis">
                <i class="bi bi-wrench-adjustable-circle"></i>
                  Jenis Alat
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Lokasi Alat") ? 'active' : '' }}" href="/alat/pendataanlokasi">
                <i class="bi bi-wrench-adjustable-circle"></i>
                  Lokasi Alat
              </a>
            </li>
          </div>
          <div class="container-fluid border border-3 rounded mb-2">
            <span class="navbar-text">
            <i class="bi bi-life-preserver"></i>
            Aktivitas
            </span>
              <li class="nav-item">
              <a class="nav-link {{($title === "Peminjaman dan Pengembalian") ? 'active' : '' }}" href="/alat/peminjamandanpengembalian">
                  <i class="bi bi-arrows-collapse"></i>
                  Peminjaman dan Pengembalian
                </a>
              </li>
          </div>
          <div class="container-fluid border border-3 rounded mb-2">
            <span class="navbar-text">
            <i class="bi bi-folder"></i>
            Laporan
            </span>
            <li class="nav-item">
              <a class="nav-link {{($title === "Laporan Peminjaman") ? 'active' : '' }}" href="/alat/laporanpeminjaman">
                <i class="bi bi bi-download"></i>
                  Peminjaman
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Laporan Pengembalian") ? 'active' : '' }}" href="/alat/laporanpengembalian">
                <i class="bi bi bi-download"></i>
                  Pengembalian
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Data Mahasiswa") ? 'active' : '' }}" href="/alat/datamahasiswa">
                <i class="bi bi bi-download"></i>
                  Data Mahasiswa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Data Peralatan") ? 'active' : '' }}" href="/alat/dataperalatan">
                <i class="bi bi bi-download"></i>
                  Data Peralatan
              </a>
            </li>
          </div>
        <form action="/logout" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Keluar
              </button>
        </form>
        @else()
        <li class="nav-item">
          <a class="nav-link {{($title === "Index") ? 'active' : '' }}" aria-current="page" href="/">
            </span>
            <i class="bi bi-house"></i>
             Menu Utama
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{($title === "Dashboard") ? 'active' : '' }}" aria-current="page" href="/alat/dashboard">
            </span>
            <i class="bi bi-pie-chart"></i>
            Dashboard
          </a>
        </li>
        <div class="container-fluid border border-3 rounded mb-2">
          <span class="navbar-text">
          <i class="bi bi-folder"></i>
          Laporan
          </span>
          <li class="nav-item">
            <a class="nav-link {{($title === "LaporanPeminjaman") ? 'active' : '' }}" href="/alat/laporanpeminjaman">
              <i class="bi bi bi-download"></i>
                Peminjaman
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "LaporanPengembalian") ? 'active' : '' }}" href="/alat/laporanpengembalian">
              <i class="bi bi bi-download"></i>
                Pengembalian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Data Mahasiswa") ? 'active' : '' }}" href="/alat/datamahasiswa">
              <i class="bi bi bi-download"></i>
                Data Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($title === "Data Peralatan") ? 'active' : '' }}" href="/alat/dataperalatan">
              <i class="bi bi bi-download"></i>
                Data Peralatan
            </a>
          </li>
        </div>
      <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
              <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
      </form>
      @endif()
      </div>
    </nav>

