<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Data Karyawan</a>
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
        <h2 class="fw-bold">Daftar Karyawan</h2>
        <div>
            <a href="/addkaryawan" class="btn btn-success"><i class="bi bi-plus-circle"></i> Tambah Karyawan</a>
            <a href="/resetkomisi" class="btn btn-danger"><i class="bi bi-arrow-clockwise"></i> Reset Komisi</a>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID Karyawan</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">NO Telepon</th>
                <th scope="col">Alamat</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Gaji Bulanan</th>
                <th scope="col">Komisi Bulan <?php echo date('F'); echo " "; echo date('Y'); ?></th>
                <th scope="col">Total Gaji <?php echo date('F'); echo " "; echo date('Y'); ?></th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($karyawan as $data)
            <tr class="@if($loop->index % 2 == 0) table-light @else table-secondary @endif">
                <td>{{ $data->idKaryawan }}</td>
                <td>{{ $data->namaKaryawan }}</td>
                <td>{{ $data->noTelp }}</td>
                <td>{{ $data->alamat }}</td>
                <td>{{ $data->tanggalMasuk }}</td>
                <td>Rp. {{ number_format($data->gajiBulanan, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($data->totalKomisi, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($data->totalGajiBulanan, 0, ',', '.') }}</td>
                <td>
                    <button onclick="detail('{{ $data->idKaryawan }}')" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button onclick="gaji('{{ $data->idKaryawan }}')" class="btn btn-success btn-sm">
                        <i class="bi bi-currency-dollar"></i> Gaji
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-4">
    <div>© 2024 Data Karyawan App | All Rights Reserved</div>
</footer>

<script>
    function detail(idKaryawan) {
        window.location.href = 'editkaryawan/' + idKaryawan;
    }

    function gaji(idKaryawan) {
        window.location.href = 'gaji/' + idKaryawan;
    }
</script>

</body>
</html>
