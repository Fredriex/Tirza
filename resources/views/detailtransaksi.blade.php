<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Detail Transaksi - {{$customer->idTransaksi}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/dataTransaksi">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Transaction Details -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Transaksi</h5>
        </div>
        <div class="card-body">
            <p><strong>No Transaksi:</strong> {{$customer->idTransaksi}}</p>
            <p><strong>Nama Customer:</strong> {{$customer->namaCustomer}}</p>
            <p><strong>Tanggal/Jam Transaksi:</strong> {{$customer->tanggal}}</p>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Detail Treatment</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Treatment</th>
                        <th>Harga (Rp)</th>
                        <th>Qty</th>
                        <th>Handled By</th>
                        <th>Subtotal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $data)
                    <tr>
                        <td>{{$data->namaTreatment}}</td>
                        <td>{{number_format($data->hargaTreatment, 0, ',', '.')}}</td>
                        <td>{{$data->qty}}</td>
                        <td>{{$data->namaKaryawan}}</td>
                        <td>{{number_format($data->subtotal, 0, ',', '.')}}</td>
                    </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td colspan="4" class="text-end">Grand Total:</td>
                        <td>{{number_format($grandtot->total, 0, ',', '.')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-5">
    <div>© 2024 Detail Transaksi App | All Rights Reserved</div>
</footer>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>