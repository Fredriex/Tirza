<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Pemasukan - Tirza Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<x-navbar active="pemasukan" />


<div class="container mt-5">
    <h1 class="text-center mb-4">Laporan Pemasukan <?php echo date('F'); echo " "; echo date('Y'); ?></h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="/resetpemasukan" class="btn btn-danger"><i class="bi bi-arrow-clockwise"></i> Reset Pemasukan</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Customer</th>
                    <th>Treatment</th>
                    <th>Tanggal</th>
                    <th>Pemasukan Kotor</th>
                    <th>HPP</th>
                    <th>Komisi</th>
                    <th>Pemasukan Bersih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemasukan as $item)
                <tr>
                    <td>{{ $item->idTransaksi }}</td>
                    <td>{{ $item->namaCustomer }}</td>
                    <td>{{ $item->namaTreatment }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>Rp.{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    <td>-Rp.{{ number_format($item->hpp, 0, ',', '.') }}</td>
                    <td>-Rp.{{ number_format($item->komisi, 0, ',', '.') }}</td>
                    <td>Rp.{{ number_format($item->pemasukanbersih, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="alert alert-info text-center">
        <h4>Total Pemasukan <?php echo date('F'); echo " "; echo date('Y'); ?> : <strong>Rp.{{ number_format($totalpemasukan, 0, ',', '.') }}</strong></h4>
    </div>
</div>

</body>
</html>
