<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk - {{ $customer->idTransaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px; /* Ukuran font kecil untuk printer thermal */
        }
        .container {
            width: 100%;
            max-width: 302px; /* Sesuai dengan 80 mm */
            margin: 0; /* Hilangkan margin otomatis */
            padding: 0;
        }
        header, footer {
            text-align: center;
            margin-bottom: 5px;
        }
        .header, .footer {
            font-size: 12px;
            font-weight: bold;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 10px;
        }
        .invoice-header h2 {
            margin: 0;
            font-size: 16px;
        }
        .invoice-header p {
            margin: 3px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 5px; /* Padding lebih kecil */
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
            font-size: 10px; /* Ukuran font header kecil */
        }
        .total-row {
            font-weight: bold;
            text-align: right;
        }
        .total-row td {
            border-top: 2px solid #000;
        }
        .footer {
            font-size: 10px;
        }
        @media print {
            body {
                width: 80mm; /* Pastikan ukuran kertas */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header">Struk</div>
        </header>

        <!-- Invoice Details -->
        <div class="invoice-header">
            <h2>Struk #{{ $customer->idTransaksi }}</h2>
            <p>Tanggal: {{ \Carbon\Carbon::parse($customer->tanggal)->format('d M Y') }}</p>
            <p>Customer: {{ $customer->namaCustomer }}</p>
        </div>

        <!-- Transaction Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Treatment</th>
                    <th>Capster</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->namaTreatment }}</td>
                        <td>{{ $item->namaKaryawan }}</td>
                        <td>{{ number_format($item->hargaTreatment, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Grand Total -->
        <table class="table">
            <tr>
                <td class="total-row" colspan="3">Grand Total</td>
                <td class="total-row">{{ number_format($grandtot->total, 2, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Footer -->
        <footer>
            <div class="footer">
                Terimakaih Telah Melakukan Treatment Di Tirza Salon!<br>
                {{ config('app.name') }} - {{ \Carbon\Carbon::now()->year }}
            </div>
        </footer>
    </div>

    <script>
        window.print();
        window.onafterprint = function () {
            window.close();
        };
    </script>
</body>
</html>
