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
          <p>{{ $material["name_material"] }}</p>
          <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($material->barcode, 'C39') }}" alt="" width="20%" height="30">
          <p>
          {{ $material["barcode"] }}
          </p>
          {{-- print -> scale=custom -> 90, pages -> 1, copies -> no checklist collate --}}
  </body>
</html>