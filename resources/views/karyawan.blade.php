<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        @media (max-width: 576px) {
            table thead { display: none; }
            table tbody tr { display: block; margin-bottom: 1rem; border: 1px solid #dee2e6; border-radius: 5px; }
            table tbody tr td { display: flex; justify-content: space-between; padding: 0.5rem; }
            table tbody tr td::before {
                content: attr(data-label);
                font-weight: bold;
                flex-basis: 40%;
                text-align: left;
            }
            table tbody tr td:last-child { text-align: center; }
        }
    </style>
</head>
<body>

<x-navbar active="karyawan" />

<!-- Content Section -->
<div class="container mt-4">
    <div class="row mb-3 align-items-center">
        <div class="col-12 col-md-6">
            <h2 class="fw-bold">Daftar Karyawan</h2>
        </div>
        <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
            <a href="/addkaryawan" class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i> Tambah Karyawan
            </a>
            <a href="/resetkomisi" class="btn btn-danger">
                <i class="bi bi-arrow-clockwise"></i> Reset Komisi
            </a>
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
                    <td data-label="ID Karyawan">{{ $data->idKaryawan }}</td>
                    <td data-label="Nama Karyawan">{{ $data->namaKaryawan }}</td>
                    <td data-label="NO Telepon">{{ $data->noTelp }}</td>
                    <td data-label="Alamat">{{ $data->alamat }}</td>
                    <td data-label="Tanggal Masuk">{{ $data->tanggalMasuk }}</td>
                    <td data-label="Gaji Bulanan">Rp. {{ number_format($data->gajiBulanan, 0, ',', '.') }}</td>
                    <td data-label="Komisi Bulanan">Rp. {{ number_format($data->totalKomisi, 0, ',', '.') }}</td>
                    <td data-label="Total Gaji">Rp. {{ number_format($data->totalGajiBulanan, 0, ',', '.') }}</td>
                    <td data-label="Action">
                        <button onclick="detail('{{ $data->idKaryawan }}')" class="btn btn-primary btn-sm mb-1">
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
