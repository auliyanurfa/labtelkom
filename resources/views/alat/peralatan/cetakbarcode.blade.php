<html>
  <head>
    {{-- <style>
        p{
        margin: 0%;
        font-size: 10px;
        text-align: left;
        }
    </style> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <div class="card" style="width: 18rem;">
        <div class="card-body text-center">
          <p class="card-text"><strong>{{ $peralatan->nama_alat }}</strong></p>
          <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($peralatan->barcode, 'C39') }}" class="img-fluid" alt="...">
          <p class="card-text">{{ $peralatan->barcode }}</p>
        </div>
      </div>
  </body>
</html>
