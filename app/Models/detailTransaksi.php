<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table; 

Class detailTransaksi{

    public function detail($idTransaksi){
        $detail = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->join('karyawan', 'detailtransaksi.idKaryawan', '=', 'karyawan.idKaryawan')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)->get();
        return $detail;    
    }

    public function grandtot($idTransaksi){
        $grandtot = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)
        ->select('transaksi.total')->first();
        return $grandtot;    
    }

    public function detailCustomer($idTransaksi){
        $detail = DB::table('detailtransaksi')
        ->join('transaksi', 'detailtransaksi.idTransaksi', '=', 'transaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->join('karyawan', 'detailtransaksi.idKaryawan', '=', 'karyawan.idKaryawan')
        ->where('detailTransaksi.idTransaksi', '=', $idTransaksi)
        ->select('transaksi.namaCustomer', 'transaksi.tanggal', 'karyawan.namaKaryawan','transaksi.idTransaksi')
        ->first();
        return $detail;    
    }

}