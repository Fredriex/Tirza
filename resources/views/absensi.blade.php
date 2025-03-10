<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <x-navbar active="karyawan" />

    <div class="container mt-4">
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold">Absensi Karyawan</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/addAbsensi" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Absensi
                </a>
            </div>
        </div>

        <!-- Filter & Search -->
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" id="search" class="form-control" placeholder="Cari karyawan...">
            </div>
            <div class="col-md-2">
                <select id="filterBulan" class="form-select">
                    <option value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="filterTahun" class="form-select">
                    <option value="">Pilih Tahun</option>
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select id="filterHari" class="form-select">
                    <option value="">Pilih Hari</option>
                    @for($i = 1; $i <= 31; $i++)
                        <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select id="filterKehadiran" class="form-select">
                    <option value="">Pilih Kehadiran</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Tidak Masuk</option>
                    <option value="Absen">Absen</option>
                </select>
            </div>
            <div class="col-md-1">
                <button id="resetFilter" class="btn btn-warning">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th onclick="sortTable(0)" style="cursor:pointer;">Nama Karyawan <i class="bi bi-arrow-down-up"></i></th>
                        <th>Kehadiran</th>
                        <th onclick="sortTable(2)" style="cursor:pointer;">Tanggal <i class="bi bi-arrow-down-up"></i></th>
                        <th>Jam Masuk</th>
                    </tr>
                </thead>
                <tbody id="absensiTable">
                    @foreach($hasil as $data)
                    <tr>
                        <td>{{$data->namaKaryawan}}</td>
                        <td>
                            @if($data->kehadiran == 'Hadir')
                                <span class="badge bg-success">{{$data->kehadiran}}</span>
                            @elseif($data->kehadiran == 'Terlambat Dengan Izin')
                                <span class="badge bg-warning text-dark">{{$data->kehadiran}}</span>
                                @elseif($data->kehadiran == 'Terlambat Tanpa Izin')
                                <span class="badge bg-danger">{{$data->kehadiran}}</span>
                            @else
                                <span class="badge bg-danger">{{$data->kehadiran}}</span>
                            @endif
                        </td>
                        <td>{{$data->tanggalmasuk}}</td>
                        <td>{{$data->jam}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', applyFilters);
        document.getElementById('filterBulan').addEventListener('change', applyFilters);
        document.getElementById('filterTahun').addEventListener('change', applyFilters);
        document.getElementById('filterHari').addEventListener('change', applyFilters);
        document.getElementById('filterKehadiran').addEventListener('change', applyFilters);
        document.getElementById('resetFilter').addEventListener('click', function() {
            document.getElementById('search').value = '';
            document.getElementById('filterBulan').value = '';
            document.getElementById('filterTahun').value = '';
            document.getElementById('filterHari').value = '';
            document.getElementById('filterKehadiran').value = '';
            applyFilters();
        });

        function applyFilters() {
            let filter = document.getElementById('search').value.toLowerCase();
            let bulan = document.getElementById('filterBulan').value;
            let tahun = document.getElementById('filterTahun').value;
            let hari = document.getElementById('filterHari').value;
            let kehadiran = document.getElementById('filterKehadiran').value;
            let rows = document.querySelectorAll('#absensiTable tr');

            rows.forEach(row => {
                let nama = row.cells[0].innerText.toLowerCase();
                let tanggal = row.cells[2].innerText.split('-');
                let rowHari = tanggal[0];
                let rowBulan = tanggal[1];
                let rowTahun = tanggal[2];
                let rowKehadiran = row.cells[1].innerText.trim();

                let match = (!filter || nama.includes(filter)) &&
                            (!bulan || rowBulan === bulan) &&
                            (!tahun || rowTahun === tahun) &&
                            (!hari || rowHari === hari) &&
                            (!kehadiran || rowKehadiran === kehadiran);

                row.style.display = match ? '' : 'none';
            });
        }
    </script>
</body>
</html>
