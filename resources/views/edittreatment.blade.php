<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Treatment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Edit Treatment: {{$gettreatment->idTreatment}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/treatment">
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
            <h4 class="mb-0">Edit Data Treatment</h4>
        </div>
        <div class="card-body">
            <form action="/changetreatment" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <!-- ID Treatment -->
                <div class="mb-3">
                    <label for="idTreatment" class="form-label">ID Treatment:</label>
                    <input type="text" name="idTreatment" class="form-control" id="idTreatment" value="{{$gettreatment->idTreatment}}" readonly>
                </div>

                <!-- Nama Treatment -->
                <div class="mb-3">
                    <label for="namaTreatment" class="form-label">Nama Treatment:</label>
                    <input type="text" name="namaTreatment" class="form-control" id="namaTreatment" value="{{$gettreatment->namaTreatment}}" required>
                </div>

                <!-- Harga Treatment -->
                <div class="mb-3">
                    <label for="hargaTreatment" class="form-label">Harga Treatment:</label>
                    <input type="number" name="hargaTreatment" class="form-control" id="hargaTreatment" value="{{$gettreatment->hargaTreatment}}" required>
                </div>

                <div class="mb-3">
                    <label for="hargaTreatment" class="form-label">HPP:</label>
                    <input type="number" name="hpp" class="form-control" id="hargaTreatment" value="{{$gettreatment->hpp}}" required>
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
    <div>© 2024 Edit Treatment App | All Rights Reserved</div>
</footer>

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
