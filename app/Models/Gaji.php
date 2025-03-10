<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class Gaji{

    public function detailKaryawan($idKaryawan){
        $data = DB::table('karyawan')
        ->where('karyawan.idKaryawan', '=', $idKaryawan)
        ->select('karyawan.idKaryawan','karyawan.namaKaryawan', 'karyawan.gajiHarian')
        ->first();
        return $data;
    }

    public function detailgaji($idKaryawan){
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

    public function totalgaji($idKaryawan){
        $gaji = DB::table('karyawan')
            ->leftJoin('rekap_komisi', 'karyawan.idKaryawan', '=', 'rekap_komisi.idKaryawan')
            ->where('karyawan.idKaryawan', '=', $idKaryawan)
            ->select(
                DB::raw('COALESCE(SUM(rekap_komisi.totalKomisi), 0) as totalKomisi'),
                DB::raw('COALESCE(SUM(rekap_komisi.totalKomisi), 0) + karyawan.gajiHarian as totalGaji')
            )
            ->groupBy('karyawan.idKaryawan', 'karyawan.gajiHarian')
            ->first();
        return $gaji;
    }
    
}