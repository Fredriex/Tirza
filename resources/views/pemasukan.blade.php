<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1">
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Customer</th>
            <th>Treatment</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Hpp</th>
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
            <td>Rp.{{ number_format($item->hpp, 0, ',', '.') }}</td>
            <td>Rp.{{ number_format($item->komisi, 0, ',', '.') }}</td>
            <td>Rp.{{ number_format($item->pemasukanbersih, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<p>Total Pemasukan: Rp.{{ number_format($totalpemasukan, 0, ',', '.') }}</p>
</body>
</html>