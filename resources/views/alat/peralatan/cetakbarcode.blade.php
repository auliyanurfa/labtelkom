<html>
  <head>
    <style>
        p{
        margin: 0%;
        font-size: 10px;
        text-align: left;
        }
    </style>
  </head>
  <body>
          <p>{{ $peralatan["nama_alat"] }}</p>
          <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($peralatan->barcode, 'C39') }}" alt="" width="20%" height="30">
          <p>
          {{ $peralatan["barcode"] }}
          </p>
  </body>
</html>
