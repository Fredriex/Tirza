<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .slip-container {
            width: 210mm;
            margin: auto;
            padding: 20mm;
            border: 1px solid #000;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            margin: 5px 0;
        }
        .info-section, .details-section {
            margin-bottom: 20px;
        }
        .info-section table, .details-section table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-section td, .details-section th, .details-section td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .details-section th {
            background-color: #f0f0f0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="slip-container">
        <div class="header">
            <h1>Tirza Salon</h1>
            <p>Jalan Pepelegi Indah No. 38, Tahun Berdiri: 2023</p>
            <p><strong>Slip Gaji Bulanan</strong></p>
        </div>
        <div class="info-section">
            <table>
                <tr>
                    <td><strong>Nama Karyawan:</strong></td>
                    <td>{{$karyawan -> namaKaryawan}}</td>
                </tr>
                <tr>
                    <td><strong>ID Karyawan:</strong></td>
                    <td>{{$karyawan -> idKaryawan}}</td>
                </tr>
                <tr>
                    <td><strong>Periode:</strong></td>
                    <td><?php echo date('F'); echo " "; echo date('Y') ?></td>
                </tr>
            </table>
        </div>
        <div class="details-section">
            <table>
                <thead>
                    <tr>
                        <th>Rincian</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gaji Pokok</td>
                        <td>{{ number_format($karyawan->gajiBulanan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Komisi</td>
                        <td>{{ number_format($totalGaji->totalKomisi, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Gaji</strong></td>
                        <td><strong>{{ number_format($totalGaji->totalGaji, 0, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p><em>Slip ini dicetak otomatis oleh sistem. Tidak memerlukan tanda tangan.</em></p>
        </div>
    </div>
</body>
<script>
    window.print();
        window.onafterprint = function () {
            window.close();
        };
    </script>
</html>
