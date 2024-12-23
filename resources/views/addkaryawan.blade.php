<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff; /* Background putih */
        }
        .navbar {
            background-color: #FFC107 !important; /* Biru Bootstrap */
        }
        .card {
            border: none; /* Hilangkan border default */
        }
        .card-header {
            background-color:rgb(0, 0, 0); /* Biru */
            color:rgb(255, 255, 255); /* Teks putih */
        }
        .btn-primary {
            background-color: #0D6EFD; /* Biru */
            border-color: #0D6EFD;
        }
        .btn-primary:hover {
            background-color:rgb(12, 82, 187); /* Biru lebih gelap */
            border-color: #0D6EFD;
        }
        .form-label {
            color: #343a40; /* Warna teks form */
        }
        .container {
            max-width: 600px; /* Lebar maksimal container */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="#">Tambah Karyawan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/karyawan"><-- Kembali</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header text-center">
            <h4>Form Tambah Karyawan</h4>
        </div>
        <div class="card-body">
            <form action="savekaryawan" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="mb-3">
                    <label for="idKaryawan" class="form-label">ID Karyawan</label>
                    <input type="text" name="idKaryawan" class="form-control" id="idKaryawan" placeholder="Masukkan ID Karyawan">
                </div>
                <div class="mb-3">
                    <label for="namaKaryawan" class="form-label">Nama Karyawan</label>
                    <input type="text" name="namaKaryawan" class="form-control" id="namaKaryawan" placeholder="Masukkan Nama Karyawan">
                </div>
                <div class="mb-3">
                    <label for="noTelp" class="form-label">No Telepon</label>
                    <input type="text" name="noTelp" class="form-control" id="noTelp" placeholder="Masukkan No Telepon">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat">
                </div>
                <div class="mb-3">
                    <label for="tanggalMasuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggalMasuk" class="form-control" id="tanggalMasuk">
                </div>
                <div class="mb-3">
                    <label for="gajiBulanan" class="form-label">Gaji</label>
                    <input type="number" name="gajiBulanan" class="form-control" id="gajiBulanan" placeholder="Masukkan Gaji Bulanan">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
