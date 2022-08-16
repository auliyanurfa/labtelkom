<table class="table table-bordered table-striped table-hover table-responsive">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama BHP</th>
        <th scope="col">Barcode</th>
        <th scope="col">Stok Awal</th>
        <th scope="col">Stok Keluar</th>
        <th scope="col">Total Stok</th>
        <th scope="col">Tanggal Pengeluaran</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($materials as $material)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $material->name_material }}</td>
          <td>{{ $material->barcode }}</td>
          <td>{{ $material->stok + $material->stok_keluar }}</td>
          <td>{{ $material->stok_keluar }}</td>
          <td>{{ $material->stok }}</td>
          <td>{{ $material->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
    </div>
</table>
