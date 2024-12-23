<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Transaksi{


    // public function simpantransaksi($x){
    //     DB::table('transaksi')->insert([
    //         'idTransaksi' => $x -> idTransaksi,
    //         'tanggal' => $x -> tanggal,
    //         'namaCustomer' => $x -> namaCustomer,
    //         'idTreatment' => $x -> idTreatment,
    //         'idKaryawan' => $x -> idKaryawan,
    //         'qty' => $x -> qty,
    //         'total' => $x -> total
    //     ]);
    // }

    // public function bacatransaksi(){
    //     $transaksi = DB::table('transaksi')
    //     ->join('treatment', 'transaksi.idTreatment', '=', 'treatment.idTreatment')
    //     ->join('karyawan', 'transaksi.idKaryawan', '=', 'karyawan.idKaryawan')
    //     ->get();
    //     return $transaksi;
    // }

// Simpan data transaksi utama
public function simpanTransaksiUtama($data) {
    DB::table('transaksi')->insert($data);
}

// Simpan detail transaksi
public function simpanDetailTransaksi($data) {
    DB::table('detailTransaksi')->insert($data);
}

// Baca transaksi lengkap dengan detail
// public function bacaTransaksi() {
//     $transaksi = DB::table('transaksi')
//     ->join('detailTransaksi', 'transaksi.idTransaksi', '=', 'detailTransaksi.idTransaksi')
//     ->select('transaksi.idTransaksi', 'transaksi.tanggal', 'transaksi.namaCustomer', 'detailTransaksi.qty', 'transaksi.total')
//     ->distinct()->get();
//     return $transaksi;
//     }

public function bacaTransaksi() {
    $transaksi = DB::table('transaksi')
        ->join('detailTransaksi', 'transaksi.idTransaksi', '=', 'detailTransaksi.idTransaksi')
        ->select(
            'transaksi.idTransaksi',
            'transaksi.tanggal',
            'transaksi.namaCustomer',
            DB::raw('SUM(detailTransaksi.qty) as totalQty'),
            'transaksi.total'
        )
        ->groupBy('transaksi.idTransaksi', 'transaksi.tanggal', 'transaksi.namaCustomer', 'transaksi.total')
        ->get();

    return $transaksi;
}




}