<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/f410459da5.js" crossorigin="anonymous"></script><script src="https://kit.fontawesome.com/f410459da5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- link style.css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">

    <title> Dashboard | {{ $title }}</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../css/dashboard.css"> 
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Politeknik Negeri Semarang</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav ms-auto">
  @auth
  <li class="nav-item">
          <a class="nav-link mx-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back , {{ auth()->user()->name }}
          </a>      
  </li>
  @else
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="/login">
        <i class="bi bi-box-arrow-right"></i> Login
      </a>
    </div>
    @endauth
  </div>
  </header>

  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  </body>
</html>

<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
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
              <a class="nav-link {{($title === "Materials") ? 'active' : '' }}" href="/BHP/material">
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
              <a class="nav-link {{($title === "Pemasukan") ? 'active' : '' }}" href="/BHP/pemasukan">
                  <i class="bi bi-arrow-bar-down"></i>
                      Pemasukan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{($title === "Pengeluaran") ? 'active' : '' }}" href="/BHP/pengeluaran">
                  <i class="bi bi-arrow-bar-up"></i>
                  Pengeluaran
                </a>
              </li>
          </div>
          <div class="container-fluid border border-3 rounded mb-2">
            <span class="navbar-text">
            <i class="bi bi-files"></i>
            Laporan
            </span>
            <li class="nav-item">
              <a class="nav-link {{($title === "LaporanPemasukan") ? 'active' : '' }}" href="/BHP/laporanpemasukan">
                <i class="bi bi-arrow-down-square"></i>
                  Pemasukan
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{($title === "LaporanPengeluaran") ? 'active' : '' }}" href="/BHP/laporanpengeluaran">
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
      </div>
    </nav>

    
@yield('container')