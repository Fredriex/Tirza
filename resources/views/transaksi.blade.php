<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .row-total {
            font-weight: bold;
            color: #0d6efd;
        }
        .btn-danger {
            margin-top: 30px;
        }
        .btn-success {
            margin-top: 10px;
        }
        .form-control:invalid {
            border-color: red;
        }
    </style>
</head>
<body>

<x-navbar active="transaksi" />


<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0">Form Transaksi Baru</h4>
        </div>
        <div class="card-body">
            <form action="/savetransaksi" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <!-- ID Transaksi -->
                <div class="mb-3">
                    <label for="idTransaksi" class="form-label">ID Transaksi:</label>
                    <input type="text" name="idTransaksi" class="form-control" value="TR<?php echo date('YmdHis') ?>" readonly>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal:</label>
                    <input type="datetime-local" name="tanggal" class="form-control">
                </div>

                <!-- Nama Customer -->
                <div class="mb-3">
                    <label for="namaCustomer" class="form-label">Nama Customer:</label>
                    <input type="text" name="namaCustomer" class="form-control" placeholder="Masukkan Nama Customer" required>
                </div>

                <!-- Treatment Section -->
                <div id="treatment-container">
                    <div class="treatment-row row">
                        <div class="col-md-4">
                            <label for="idTreatment" class="form-label">Treatment:</label>
                            <select name="idTreatment[]" class="form-select" onchange="updateRowTotal(this)" required>
                                @foreach($treatment as $data)
                                <option value="{{ $data->idTreatment }}" data-price="{{ $data->hargaTreatment }}">
                                    {{ $data->namaTreatment }} | Rp {{ number_format($data->hargaTreatment, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="idKaryawan" class="form-label">Karyawan:</label>
                            <select name="idKaryawan[]" class="form-select" required>
                                @foreach($karyawan as $data)
                                <option value="{{ $data->idKaryawan }}">
                                    {{ $data->namaKaryawan }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="qty" class="form-label">QTY:</label>
                            <input type="number" name="qty[]" value="1" class="form-control" min="1" onchange="updateRowTotal(this)" required>
                        </div>
                        <div class="col-md-2">
                            <label for="subtotal" class="form-label">Subtotal:</label>
                            <div>
                                <span class="row-total">Rp 0</span>
                                <input type="hidden" name="subtotal[]" value="0">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success" onclick="addTreatmentRow()">+ Tambah Treatment</button><br><br>
                
                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="metode" class="form-label">Metode Pembayaran:</label>
                    <select name="metode" id="metode" class="form-select" required>
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="ovo">OVO</option>
                        <option value="transfer">Transfer</option>
                        <option value="gopay">GoPay</option>
                        <option value="dana">DANA</option>
                    </select>
                </div>


                <!-- Total -->
                <div class="mb-3">
                    <label for="total" class="form-label">Total:</label>
                    <div>
                        <span class="text-success fs-5" id="total-display">Rp 0</span>
                    </div>
                    <input type="hidden" id="total-price" name="total" readonly>
                </div>

                <!-- Bayar -->
                <div class="mb-3">
                    <label for="bayar" class="form-label">Bayar:</label>
                    <input type="text" id="bayar" name="bayar" class="form-control" placeholder="Masukkan jumlah bayar" required>
                </div>

                <!-- Kembali -->
                <div class="mb-3">
                    <label for="kembali" class="form-label">Kembali:</label>
                    <input type="text" id="kembali" name="kembali" class="form-control" readonly>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-50">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center text-muted py-3 mt-5">
    <div>© 2024 Tirza Salon | All Rights Reserved</div>
</footer>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const bayarInput = document.getElementById('bayar');
    const kembaliInput = document.getElementById('kembali');
    const totalInput = document.getElementById('total-price');

    // Hitung kembalian saat nilai pembayaran berubah
    bayarInput.addEventListener('input', function () {
        const bayar = parseFloat(bayarInput.value || 0);
        const total = parseFloat(totalInput.value || 0);
        const kembali = bayar - total;

        kembaliInput.value = kembali >= 0 ? kembali : 0; // Tidak boleh negatif
    });
});


    // Fungsi untuk menambahkan baris treatment
    function addTreatmentRow() {
        const container = document.getElementById('treatment-container');
        const newRow = document.createElement('div');
        newRow.classList.add('treatment-row', 'row');
        newRow.innerHTML = `
            <div class="col-md-4">
                <select name="idTreatment[]" class="form-select" onchange="updateRowTotal(this)">
                    @foreach($treatment as $data)
                    <option value="{{ $data->idTreatment }}" data-price="{{ $data->hargaTreatment }}">
                        {{ $data->namaTreatment }} - Rp{{ number_format($data->hargaTreatment, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="idKaryawan[]" class="form-select">
                    @foreach($karyawan as $data)
                    <option value="{{ $data->idKaryawan }}">
                        {{ $data->namaKaryawan }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="qty[]" value="1" class="form-control" onchange="updateRowTotal(this)">
            </div>
            <div class="col-md-2">
                <span class="row-total">0</span>
                <input type="hidden" name="subtotal[]" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Hapus</button>
            </div>
        `;
        container.appendChild(newRow);

        // Hitung ulang subtotal untuk baris yang baru ditambahkan
        const treatmentSelect = newRow.querySelector('select[name="idTreatment[]"]');
        updateRowTotal(treatmentSelect);
    }

    // Fungsi untuk menghapus baris treatment
    function removeRow(button) {
        const row = button.closest('.treatment-row');
        row.remove();
        updateTotalPrice();
    }

    // Fungsi untuk menghitung subtotal per baris
    function updateRowTotal(element) {
        const row = element.closest('.treatment-row');
        const treatmentSelect = row.querySelector('select[name="idTreatment[]"]');
        const qtyInput = row.querySelector('input[name="qty[]"]');
        const subtotalSpan = row.querySelector('.row-total');
        const subtotalInput = row.querySelector('input[name="subtotal[]"]');

        const price = parseFloat(treatmentSelect.selectedOptions[0].dataset.price || 0);
        const qty = parseInt(qtyInput.value || 1);

        const subtotal = price * qty;
        subtotalSpan.textContent = formatRupiah(subtotal);
        subtotalInput.value = subtotal;

        updateTotalPrice();
    }

    // Fungsi untuk menghitung total keseluruhan
    function updateTotalPrice() {
        const subtotals = document.querySelectorAll('input[name="subtotal[]"]');
        let total = 0;

        subtotals.forEach(subtotal => {
            total += parseFloat(subtotal.value || 0);
        });

        // Tampilkan total dalam format Rupiah
        const totalInput = document.getElementById('total-price');
        totalInput.value = total; // Tetap simpan angka asli di input
        totalInput.previousElementSibling.textContent = formatRupiah(total); // Tampilkan Rupiah di elemen sebelum input
    }

    // Fungsi untuk memformat angka ke dalam format Rupiah
    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID', { maximumFractionDigits: 0 });
    }

    // Panggil updateRowTotal() setelah halaman dimuat untuk inisialisasi default nilai subtotal
    document.addEventListener('DOMContentLoaded', function () {
        const treatmentRows = document.querySelectorAll('.treatment-row');
        treatmentRows.forEach(row => {
            const treatmentSelect = row.querySelector('select[name="idTreatment[]"]');
            updateRowTotal(treatmentSelect);
        });
    });
</script>


</body>
</html>
