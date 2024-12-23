<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Treatment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #ffffff; /* Background putih */
        }
        .navbar {
            background-color: #FFC107 !important; /* Kuning */
        }
        .card {
            border: none; /* Hilangkan border default */
        }
        .card-header {
            background-color: rgb(0, 0, 0); /* Hitam */
            color: rgb(255, 255, 255); /* Teks putih */
        }
        .btn-primary {
            background-color: #0D6EFD; /* Biru */
            border-color: #0D6EFD;
        }
        .btn-primary:hover {
            background-color: rgb(12, 82, 187); /* Biru lebih gelap */
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
        <a class="navbar-brand text-dark" href="#">Tambah Treatment</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="/treatment"><-- Kembali</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header text-center">
            <h4>Form Tambah Treatment</h4>
        </div>
        <div class="card-body">
            <form action="savetreatment" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="mb-3">
                    <label for="idTreatment" class="form-label">ID Treatment</label>
                    <input type="text" name="idTreatment" class="form-control" id="idTreatment" placeholder="Masukkan ID Treatment">
                </div>
                <div class="mb-3">
                    <label for="namaTreatment" class="form-label">Nama Treatment</label>
                    <input type="text" name="namaTreatment" class="form-control" id="namaTreatment" placeholder="Masukkan Nama Treatment">
                </div>
                <div class="mb-3">
                    <label for="hargaTreatment" class="form-label">Harga Treatment</label>
                    <input type="number" name="hargaTreatment" class="form-control" id="hargaTreatment" placeholder="Masukkan Harga Treatment">
                </div>
                <div class="mb-3">
                    <label for="hargaTreatment" class="form-label">HPP</label>
                    <input type="number" name="hpp" class="form-control" id="hargaTreatment" placeholder="Masukkan HPP">
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
