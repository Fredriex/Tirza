<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<x-navbar active="komisi" />


<table  class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nama karyawan</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Gaji Komisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gaji as $data)
            <tr>
                <td>{{$data->namaKaryawan}}</td>
                <td>{{$data->idTransaksi}}</td>
                <td>{{$data->tanggal}}</td>
                <td>{{$data->gajiKomisi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>