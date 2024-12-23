<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Treatment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Data Treatment</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="/dataTransaksi">Data Transaksi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Content Section -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Daftar Treatment</h2>
        <a href="/addtreatment" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Treatment</a>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID Treatment</th>
                    <th scope="col">Nama Treatment</th>
                    <th scope="col">Harga Treatment</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treatment as $data)
                <tr>
                    <td>{{ $data->idTreatment }}</td>
                    <td>{{ $data->namaTreatment }}</td>
                    <td>Rp. {{ number_format($data->hargaTreatment, 0, ',', '.') }}</td>
                    <td>
                        <button onclick="detail('{{ $data->idTreatment }}')" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-4">
    <div>© 2024 Data Treatment App | All Rights Reserved</div>
</footer>

<script>
    function detail(idTreatment1) {
        window.location.href = 'edittreatment/' + idTreatment1;
    }
</script>

</body>
</html>
