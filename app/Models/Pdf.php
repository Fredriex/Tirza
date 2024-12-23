<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Pdf{

    public function detailPdf($idTransaksi){
        $detail = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->join('karyawan', 'detailtransaksi.idKaryawan', '=', 'karyawan.idKaryawan')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)->get();
        return $detail;    
    }

    public function grandtotPdf($idTransaksi){
        $grandtot = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)
        ->select('transaksi.total')->first();
        return $grandtot;    
    }

    public function detailCustomerPdf($idTransaksi){
        $detail = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->join('karyawan', 'detailtransaksi.idKaryawan', '=', 'karyawan.idKaryawan')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)
        ->select('transaksi.namaCustomer', 'transaksi.tanggal', 'karyawan.namaKaryawan','transaksi.idTransaksi')
        ->first();
        return $detail;    
    }

    public function detailKaryawanPdf($idKaryawan){
        $data = DB::table('karyawan')
        ->where('karyawan.idKaryawan', '=', $idKaryawan)
        ->select('karyawan.idKaryawan','karyawan.namaKaryawan', 'karyawan.gajiBulanan')
        ->first();
        return $data;
    }

    public function detailgajiPdf($idKaryawan){
        $data = DB::table('karyawan')
        ->join('detailgaji', 'karyawan.idKaryawan', '=', 'detailgaji.idKaryawan')
        ->join('transaksi', 'detailgaji.idTransaksi', '=', 'transaksi.idTransaksi')
        ->join('treatment', 'detailgaji.idTreatment', '=', 'treatment.idTreatment')
        ->join('komisi', 'detailgaji.idTransaksi', '=', 'komisi.idTransaksi')
        ->join('rekap_komisi', 'karyawan.idKaryawan', '=', 'rekap_komisi.idKaryawan')
        ->where('karyawan.idKaryawan', '=', $idKaryawan)
        ->select('detailgaji.idTransaksi', 
        'transaksi.tanggal', 
        'transaksi.namaCustomer',
        'treatment.namaTreatment',
        'detailgaji.qty', 
        'detailgaji.subtotal',
        'rekap_komisi.totalKomisi',
        DB::raw('detailgaji.subtotal * 0.1 as komisi'))
        ->distinct()
        ->get();
        return $data;
    }

    public function totalgajiPdf($idKaryawan){
        $gaji = DB::table('karyawan')
            ->leftJoin('rekap_komisi', 'karyawan.idKaryawan', '=', 'rekap_komisi.idKaryawan')
            ->where('karyawan.idKaryawan', '=', $idKaryawan)
            ->select(
                DB::raw('COALESCE(SUM(rekap_komisi.totalKomisi), 0) as totalKomisi'),
                DB::raw('COALESCE(SUM(rekap_komisi.totalKomisi), 0) + karyawan.gajiBulanan as totalGaji')
            )
            ->groupBy('karyawan.idKaryawan', 'karyawan.gajiBulanan')
            ->first();
        return $gaji;
    }


}