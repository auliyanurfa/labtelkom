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
      <div class="navbar-nav ms-auto">
      @auth
      <li class="nav-item">
              <a class="nav-link mx-3" href="#" aria-expanded="false">
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

    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 d-md-block">
                <div class="position-sticky pt-3 my-5 text-center">
                  @if(session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  <form action="/login" method="post">
                    @csrf
                    <h1 class="h4 mb-3 fw-normal text-center">Please Login</h1>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-2 @error('username') is-invalid @enderror" id="username" placeholder="username" name="username" autofocus required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control mb-2" id="password" placeholder="Password" name="password">
                        <label for="password">Password</label>
                    </div>
                        <button class="w-50 btn btn-lg btn-primary" type="submit">Login</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  </body>
</html>
