<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            border-radius: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-bottom: 1px solid #ddd;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 0.875rem;
                padding: 0.5rem;
                border: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                flex: 1;
                text-transform: capitalize;
            }
        }
    </style>
</head>
<body>

<x-navbar active="dataTransaksi" />

<!-- Table Section -->
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-0">Daftar Transaksi</h2>
            <a href="/exportTransaksi" class="btn btn-success bi bi-printer"> Export Excel</a>
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
                            <th>Metode</th>
                            <th>Bayar</th>
                            <th>Kembali</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataTR as $data)
                        <tr>
                            <td data-label="ID Transaksi">{{$data->idTransaksi}}</td>
                            <td data-label="Nama Customer">{{$data->namaCustomer}}</td>
                            <td data-label="Tanggal">{{$data->tanggal}}</td>
                            <td data-label="Qty">{{$data->totalQty}}</td>
                            <td data-label="Total">Rp. {{number_format($data->total, 0, ',', '.')}}</td>
                            <td data-label="Metode">{{$data->metode}}</td>
                            <td data-label="Bayar">Rp. {{number_format($data->bayar, 0, ',', '.')}}</td>
                            <td data-label="Kembali">Rp. {{number_format($data->kembali, 0, ',', '.')}}</td>
                            <td data-label="Action">
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
    <div>&copy; 2024 Data Transaksi App | All Rights Reserved</div>
</footer>

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
