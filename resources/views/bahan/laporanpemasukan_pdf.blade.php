<html>
  <head>
    <style>
      td{
        text-align: center;
      }
      #BHP {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 12px;
        width: 100%;
      }

      #BHP td, #BHP th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #BHP tr:nth-child(even){background-color: #f2f2f2;}

      #BHP tr:hover {background-color: #ddd;}

      #BHP th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #222624;
        color: white;
      }
      h3 {
        text-align: center;
      }
    </style>
  </head> 
  <body>
    <h3>Laporan Pemasukan Data Bahan Habis Pakai Laboratorium Barat</h3>
    <h3>Politeknik Negeri Semarang</h3>
    <p>{{ $date }}</p>
    <table id="BHP" width="100%">
      <tr>
            <th scope="col">No</th>
            <th scope="col">Nama BHP</th>
            <th scope="col">Barcode</th>
            <th scope="col">Stok Awal</th>
            <th scope="col">Stok Masuk</th>
            <th scope="col">Total Stok</th>
            <th scope="col">Waktu Masuk</th>
      </tr>
      <tbody>
        @foreach ($material as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->name_material }}</td>
          <td>{{ $item->barcode }}</td>
          <td>{{ $item->stok - $item->stok_masuk }}</td>
          <td>{{ $item->stok_masuk }}</td>
          <td>{{ $item->stok }}</td>
          <td>{{ $item->created_at }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>