<!doctype html>
<html lang="en">
  <head>
  <style>
     td{
        text-align: center;
      }
      #data {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 12px;
        width: 100%;
      }

      #data td, #data th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #data tr:nth-child(even){background-color: #f2f2f2;}

      #data tr:hover {background-color: #ddd;}

      #data th {
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
    <div class="row">
      <h3>STOK BAHAN HABIS PAKAI PRAKTIKUM LAB BARAT</h3>
      <p>{{ $date }}</p>
      <table id="data">
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
            <td>{{ $loop->iteration }}</td>
            <td>{{ $material->name_material }}</td>
            <td>{{ $material->barcode }}</td>
            <td>{{ $material->stok }}</td>
            <td>{{ $material->satuan }}</td>
          </tr>
      
                @endforeach
              </tbody>
      </table>
    </div>
</body>
</html>