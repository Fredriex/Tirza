<?php

namespace App\Exports;
use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class exportTransaksi implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transaksi = DB::table('transaksi')
        ->join('detailTransaksi', 'transaksi.idTransaksi', '=', 'detailTransaksi.idTransaksi')
        ->select(
            'transaksi.idTransaksi',
            'transaksi.tanggal',
            'transaksi.namaCustomer',
            DB::raw('SUM(detailTransaksi.qty) as totalQty'),
            'transaksi.total',
            'transaksi.metode',
            'transaksi.bayar',
            'transaksi.kembali'
        )
        ->groupBy('transaksi.idTransaksi', 'transaksi.tanggal', 'transaksi.namaCustomer', 'transaksi.total')
        ->get();

    return $transaksi;
    }
}
