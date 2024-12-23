<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container">
    <a class="navbar-brand" href="#">Tirza Salon</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/treatment">Data Treatment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/karyawan">Data Karyawan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/komisi">Komisi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/transaksi">Buat Transaksi</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Table Section -->
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h2 class="fw-bold">Daftar Transaksi</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Customer</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataTR as $data)
                        <tr>
                            <td>{{$data->idTransaksi}}</td>
                            <td>{{$data->namaCustomer}}</td>
                            <td>{{$data->tanggal}}</td>
                            <td>{{$data->totalQty}}</td>
                            <td>Rp. {{number_format($data->total, 0, ',', '.')}}</td>
                            <td>
                                <button onclick="detail('{{$data->idTransaksi}}')" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                                <a href="pdf/{{$data->idTransaksi}}" target="_blank" class="btn btn-success btn-sm">
                                  <i class="bi bi-printer"></i> Print
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-5">
    <div>© 2024 Data Transaksi App | All Rights Reserved</div>
</footer>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
    function detail(idTransaksi1) {
        idTransaksi = idTransaksi1;
        window.location.href = 'detail/' + idTransaksi;
    }

    function print(idTransaksi1) {
        idTransaksi = idTransaksi1;
        window.location.href = 'pdf/' + idTransaksi, '_blank';
    }
</script>
</body>
</html>
