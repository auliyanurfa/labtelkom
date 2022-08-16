<!-- NAVBAR -->
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-5">
        <ul class="nav flex-column">
          
@if(auth()->user()->role_id==1)
          <li class="nav-item">
            <a class="nav-link {{($title === "Index") ? 'active' : '' }}" aria-current="page" href="/">
              </span>
              <i class="bi bi-house-fill"></i>
               Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{($title === "Dashboard") ? 'active' : '' }}" aria-current="page" href="/BHP/dashboard">
              </span>
              <i class="bi bi-clipboard-pulse"></i>
              Dashboard
            </a>
          </li>
            <div class="container-fluid border border-3 rounded mb-2">
              <span class="navbar-text">
              <i class="bi bi-clipboard-minus-fill"></i>
              Data
              </span>
            <li class="nav-item">
                <a class="nav-link {{($title === "Users") ? 'active' : '' }}" href="/BHP/user">
                  <i class="bi bi-people-fill"></i>
                  User
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "bhp") ? 'active' : '' }}" href="/BHP/dataBHP">
                <i class="bi bi-wrench-adjustable-circle"></i>
                    Bahan Habis Pakai
              </a>
            </li>
          </div>
          <div class="container-fluid border border-3 rounded mb-2">
            <span class="navbar-text">
            <i class="bi bi-life-preserver"></i>
            Aktivitas
            </span>
              <li class="nav-item">
              <a class="nav-link {{($title === "Pemasukan") ? 'active' : '' }}" href="/BHP/aktivitaspemasukan">
                  <i class="bi bi-arrow-bar-down"></i>
                      Pemasukan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{($title === "Pengeluaran") ? 'active' : '' }}" href="/BHP/aktivitaspengeluaran">
                  <i class="bi bi-arrow-bar-up"></i>
                  Pengeluaran
                </a>
              </li>
          </div>
          <li class="nav-item">
          <a class="nav-link {{($title === "Stok") ? 'active' : '' }}" href="/BHP/stok">
              <i class="bi bi-minecart"></i>
              Stok
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link {{($title === "Akun") ? 'active' : '' }}" href="/BHP/akun">
            <i class="bi bi-person-fill"></i>
            Akun
            </a>
          </li>
        </ul>
        <form action="/logout" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
        </form>
@else()
          <li class="nav-item">
            <a class="nav-link {{($title === "Index") ? 'active' : '' }}" aria-current="page" href="/">
              </span>
              <i class="bi bi-house-fill"></i>
               Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{($title === "Dashboard") ? 'active' : '' }}" aria-current="page" href="/BHP/dashboard">
              </span>
              <i class="bi bi-clipboard-pulse"></i>
              Dashboard
            </a>
          </li>
          <div class="container-fluid border border-3 rounded mb-2">
            <span class="navbar-text">
            <i class="bi bi-files"></i>
            Laporan
            </span>
            <li class="nav-item">
              <a class="nav-link {{($title === "Laporan Pemasukan BHP") ? 'active' : '' }}" href="/BHP/laporanpemasukan">
                <i class="bi bi-arrow-down-square"></i>
                  Pemasukan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "Laporan Pengeluaran BHP") ? 'active' : '' }}" href="/BHP/laporanpengeluaran">
                <i class="bi bi-arrow-up-square"></i>
                  Pengeluaran
              </a>
            </li>
          </div>
          <li class="nav-item">
          <a class="nav-link {{($title === "Stok") ? 'active' : '' }}" href="/BHP/stok">
              <i class="bi bi-minecart"></i>
              Stok
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link {{($title === "Akun") ? 'active' : '' }}" href="/BHP/akun">
            <i class="bi bi-person-fill"></i>
            Akun
            </a>
          </li>
        </ul>
        <form action="/logout" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
        </form>
        @endif()
      </div>
    </nav>

<!-- END NAVBAR -->
