<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Pemasukan{

    public function pemasukan()
{
    return DB::table('pemasukan')
        ->join('detailtransaksi', 'pemasukan.idTransaksi', '=', 'detailtransaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->select('*',
        DB::raw('detailtransaksi.subtotal * 0.1 as komisi'),
        DB::raw('(detailtransaksi.subtotal) - (detailtransaksi.subtotal * 0.1) - (treatment.hpp) as pemasukanbersih'))
        ->get(); 
}

public function totalpemasukan()
{
    return DB::table('pemasukan')
        ->join('detailtransaksi', 'pemasukan.idTransaksi', '=', 'detailtransaksi.idTransaksi')
        ->join('treatment', 'detailtransaksi.idTreatment', '=', 'treatment.idTreatment')
        ->select(DB::raw('SUM((detailtransaksi.subtotal) - (detailtransaksi.subtotal * 0.1) - (treatment.hpp)) as total_pemasukan'))
        ->value('total_pemasukan'); 
}

}