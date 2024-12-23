<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Edit Karyawan: {{$getkaryawan->idKaryawan}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/karyawan">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Form Section -->
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Karyawan</h4>
        </div>
        <div class="card-body">
            <form action="/changekaryawan" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <!-- ID Karyawan -->
                <div class="mb-3">
                    <label for="idKaryawan" class="form-label">ID Karyawan:</label>
                    <input type="text" name="idKaryawan" class="form-control" id="idKaryawan" value="{{$getkaryawan->idKaryawan}}" readonly>
                </div>

                <!-- Nama Karyawan -->
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">Nama Karyawan:</label>
                    <input type="text" name="namaKaryawan" class="form-control" id="namaKaryawan" value="{{$getkaryawan->namaKaryawan}}" required>
                </div>

                <!-- Nama Karyawan -->
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">No Telp:</label>
                    <input type="text" name="noTelp" class="form-control" id="namaKaryawan" value="{{$getkaryawan->noTelp}}" required>
                </div>

                
                <!-- Nama Karyawan -->
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">Alamat:</label>
                    <input type="text" name="alamat" class="form-control" id="namaKaryawan" value="{{$getkaryawan->alamat}}" required>
                </div>

                
                <!-- Nama Karyawan -->
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">Tanggal Masuk:</label>
                    <input type="date" name="tanggalMasuk" class="form-control" id="namaKaryawan" value="{{$getkaryawan->tanggalMasuk}}" required>
                </div>

                <!-- Gaji -->
                <div class="mb-3">
                    <label for="gajiBulanan" class="form-label">Gaji Bulanan:</label>
                    <input type="number" name="gajiBulanan" class="form-control" id="gajiBulanan" value="{{$getkaryawan->gajiBulanan}}" required>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2" name="simpan" value="simpan">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="submit" class="btn btn-danger" name="hapus" value="hapus">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-5">
    <div>© 2024 Edit Karyawan App | All Rights Reserved</div>
</footer>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
