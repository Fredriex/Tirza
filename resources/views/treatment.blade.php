<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Treatment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            .table thead {
                display: none;
            }
            .table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 10px;
            }
            .table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                font-size: 14px;
                border: none;
            }
            .table td::before {
                content: attr(data-label);
                font-weight: bold;
                flex-basis: 50%;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<x-navbar active="treatment" />

<!-- Content Section -->
<div class="container mt-4">
    <div class="row mb-3 align-items-center">
        <div class="col-12 col-md-6">
            <h2 class="fw-bold">Daftar Treatment</h2>
        </div>
        <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
            <a href="/addtreatment" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Treatment
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID Treatment</th>
                    <th scope="col">Nama Treatment</th>
                    <th scope="col">Harga Treatment</th>
                    <th scope="col">HPP</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treatment as $data)
                <tr>
                    <td data-label="ID Treatment">{{ $data->idTreatment }}</td>
                    <td data-label="Nama Treatment">{{ $data->namaTreatment }}</td>
                    <td data-label="Harga Treatment">Rp. {{ number_format($data->hargaTreatment, 0, ',', '.') }}</td>
                    <td data-label="HPP">Rp. {{ number_format($data->hpp, 0, ',', '.') }}</td>
                    <td data-label="Action">
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
