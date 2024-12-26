<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaji {{$gaji->namaKaryawan}} - {{ date('F Y') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #ffc107;
            color: #212529;
        }
        .table th {
            text-align: center;
        }
        .table td {
            text-align: center;
        }
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
<nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="#">
            <i class="fas fa-money-check-alt"></i> Gaji Karyawan
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-light btn-sm text-dark fw-bold" href="/dataTransaksi">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Informasi Karyawan -->
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="mb-0">Informasi Karyawan</h5>
        </div>
        <div class="card-body">
            <p><strong>Nama Karyawan:</strong> {{$gaji->namaKaryawan}}</p>
            <p><strong>Gaji Bulanan:</strong> Rp. {{ number_format($gaji->gajiBulanan, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Rincian Gaji -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="mb-0">Rincian Gaji</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Nama Customer</th>
                            <th>Treatment</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Komisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gajikomisi as $data)
                        <tr>
                            <td data-label="ID Transaksi">{{$data->idTransaksi}}</td>
                            <td data-label="Tanggal">{{$data->tanggal}}</td>
                            <td data-label="Nama Customer">{{$data->namaCustomer}}</td>
                            <td data-label="Treatment">{{$data->namaTreatment}}</td>
                            <td data-label="Qty">{{$data->qty}}</td>
                            <td data-label="Subtotal">Rp. {{ number_format($data->subtotal, 0, ',', '.') }}</td>
                            <td data-label="Komisi">Rp. {{ number_format($data->komisi, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Ringkasan Gaji -->
<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Ringkasan Gaji</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span><strong>Gaji Bulanan:</strong></span>
                <span>Rp. {{ number_format($gaji->gajiBulanan, 0, ',', '.') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><strong>Total Komisi:</strong></span>
                <span>Rp. {{ number_format($totalgaji->totalKomisi ?? 0, 0, ',', '.') }}</span>
            </li>
            <!-- Garis Penjumlahan dengan Ikon "+" -->
            <li class="list-group-item">
                <div class="d-flex align-items-center justify-content-between">
                    <hr class="flex-grow-1 my-1">
                    <span class="ms-2 text-primary"><i class="fas fa-plus"></i></span>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span><strong>Total Gaji:</strong></span>
                <span>Rp. {{ number_format($totalgaji->totalGaji ?? 0, 0, ',', '.') }}</span>
            </li>
        </ul>
        <!-- Tombol Slip Gaji -->
        <div class="text-center mt-4">
            <button onclick="slip('{{ $gaji->idKaryawan }}')" class="btn btn-success btn-sm">
                <i class="fas fa-print"></i> Slip Gaji
            </button>
        </div>
    </div>
</div>

</body>
<script>
    function slip(idKaryawan) {
        window.location.href = '/slipgaji/' + idKaryawan;
    }
</script>
</html>
