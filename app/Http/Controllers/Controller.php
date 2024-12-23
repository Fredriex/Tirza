<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Karyawan;
use App\Models\Treatment;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Komisi;
use App\Models\Gaji;
use App\Models\Pdf;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Home
    public function home()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    // Treatment
    public function treatment()
    {
        $treatments = (new Treatment())->bacaTreatment();
        return view('treatment', ['treatment' => $treatments]);
    }

    public function addtreatment()
    {
        return view('addtreatment');
    }

    public function savetreatment(Request $request)
    {
        $treatment = new Treatment();
        $treatment->simpanTreatment($request);
        return redirect()->route('treatment');
    }

    public function edittreatment($idTreatment)
    {
        $treatment = (new Treatment())->gettreatment($idTreatment);
        return view('edittreatment', ['gettreatment' => $treatment]);
    }

    public function changetreatment(Request $request)
    {
        $treatment = new Treatment();

        if (isset($request->simpan)) {
            $treatment->edittreatment($request);
        }

        if (isset($request->hapus)) {
            $treatment->deletetreatment($request->idTreatment);
        }

        return redirect()->route('treatment');
    }

    // Karyawan
    public function karyawan()
    {
        $karyawans = (new Karyawan())->bacaKaryawankomisi();
        return view('karyawan', ['karyawan' => $karyawans]);
    }

    public function addkaryawan()
    {
        return view('addkaryawan');
    }

    public function savekaryawan(Request $request)
    {
        $karyawan = new Karyawan();
        $karyawan->simpankaryawan($request);
        return redirect()->route('karyawan');
    }

    public function editkaryawan($idKaryawan)
    {
        $karyawan = (new Karyawan())->getkaryawan($idKaryawan);
        return view('editkaryawan', ['getkaryawan' => $karyawan]);
    }

    public function changekaryawan(Request $request)
    {
        $karyawan = new Karyawan();

        if (isset($request->simpan)) {
            $karyawan->editkaryawan($request);
        }

        if (isset($request->hapus)) {
            $karyawan->deletekaryawan($request->idKaryawan);
        }

        return redirect()->route('karyawan');
    }

    // Transaksi
    public function transaksi()
    {
        $treatments = (new Treatment())->bacaTreatment();
        $treatmentOptions = DB::table('treatment')->select('idTreatment', 'namaTreatment', 'hargaTreatment')->get();
        $karyawans = (new Karyawan())->bacaKaryawan();

        return view('transaksi', [
            'treatment' => $treatments,
            'treatment2' => $treatmentOptions,
            'karyawan' => $karyawans
        ]);
    }

    public function savetransaksi(Request $request)
    {
        $idTransaksi = $request->input('idTransaksi');
        $tanggal = $request->input('tanggal');
        $namaCustomer = $request->input('namaCustomer');
        $total = $request->input('total');

        DB::table('transaksi')->insert([
            'idTransaksi' => $idTransaksi,
            'tanggal' => $tanggal,
            'namaCustomer' => $namaCustomer,
            'total' => $total
        ]);

        DB::table('pemasukan')->insert([
            'idTransaksi' => $idTransaksi,
            'tanggal' => $tanggal,
            'namaCustomer' => $namaCustomer,
            'total' => $total
        ]);

        $idTreatmentList = $request->input('idTreatment');
        $idKaryawanList = $request->input('idKaryawan');
        $qtyList = $request->input('qty');
        $subtotalList = $request->input('subtotal');

        for ($i = 0; $i < count($idTreatmentList); $i++) {
            $subtotal = $subtotalList[$i];
            $komisi = $subtotal * 0.1;

            DB::table('detailtransaksi')->insert([
                'idTransaksi' => $idTransaksi,
                'idTreatment' => $idTreatmentList[$i],
                'idKaryawan' => $idKaryawanList[$i],
                'qty' => $qtyList[$i],
                'subtotal' => $subtotal
            ]);

            DB::table('detailgaji')->insert([
                'idTransaksi' => $idTransaksi,
                'idTreatment' => $idTreatmentList[$i],
                'idKaryawan' => $idKaryawanList[$i],
                'qty' => $qtyList[$i],
                'subtotal' => $subtotal
            ]);

            DB::table('komisi')->insert([
                'idTransaksi' => $idTransaksi,
                'idKaryawan' => $idKaryawanList[$i],
                'gajiKomisi' => $komisi,
                'tanggal' => $tanggal
            ]);
        }

        return redirect('/dataTransaksi');
    }

    public function dataTransaksi()
    {
        $transaksis = (new Transaksi())->bacatransaksi();
        return view('datatransaksi', ['dataTR' => $transaksis]);
    }

    public function detail($idTransaksi)
    {
        $detail = (new DetailTransaksi())->detail($idTransaksi);
        $grandTotal = (new DetailTransaksi())->grandtot($idTransaksi);
        $customer = (new DetailTransaksi())->detailCustomer($idTransaksi);

        return view('detailtransaksi', [
            'detail' => $detail,
            'grandtot' => $grandTotal,
            'customer' => $customer
        ]);
    }

    // Komisi
    public function komisi()
    {
        $komisis = (new Komisi())->bacakomisi();
        return view('komisi', ['gaji' => $komisis]);
    }

    public function komisikaryawan($idKaryawan)
    {
        $komisi = (new Komisi())->hitungkomisi($idKaryawan);
        return view('penggajian', ['komisi' => $komisi]);
    }

    public function resetkomisi()
    {
        (new Karyawan())->resetkomisi();
        return redirect()->route('karyawan');
    }

    // Gaji
    public function gaji($idKaryawan)
    {
        $karyawanDetail = (new Gaji())->detailKaryawan($idKaryawan);
        $gajiDetail = (new Gaji())->detailgaji($idKaryawan);
        $totalGaji = (new Gaji())->totalgaji($idKaryawan);

        return view('gaji', [
            'gaji' => $karyawanDetail,
            'gajikomisi' => $gajiDetail,
            'totalgaji' => $totalGaji
        ]);
    }

    // PDF
    public function pdf($idTransaksi)
    {
        $details = (new Pdf())->detailPdf($idTransaksi);
        $grandTotal = (new Pdf())->grandtotPdf($idTransaksi);
        $customer = (new Pdf())->detailCustomerPdf($idTransaksi);

        return view('pdf', [
            'detail' => $details,
            'grandtot' => $grandTotal,
            'customer' => $customer
        ]);
    }

    public function slipgaji($idKaryawan)
    {
        $karyawan = (new Pdf())->detailKaryawanPdf($idKaryawan);
        $gajiDetails = (new Pdf())->detailgajiPdf($idKaryawan);
        $totalGaji = (new Pdf())->totalgajiPdf($idKaryawan);

        return view('slipgaji', [
            'karyawan' => $karyawan,
            'detailGaji' => $gajiDetails,
            'totalGaji' => $totalGaji
        ]);
    }

    public function pemasukan()
    {
        $x = new Pemasukan();
        $pemasukan = $x->pemasukan();
        $totalpemasukan = $x->totalpemasukan();
        return view('pemasukan', ["pemasukan" => $pemasukan , "totalpemasukan" => $totalpemasukan]);
    }

    public function pengeluaran()
    {
        return view('pengeluaran');
    }


}
