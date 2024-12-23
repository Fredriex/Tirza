<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Komisi{

    public function bacakomisi(){
        $komisi = DB::table('komisi')
        ->join('karyawan', 'karyawan.idKaryawan', '=', 'komisi.idKaryawan')
        ->get();
        return $komisi;
    }

    public function hitungkomisi($idKaryawan){
        $total = DB::table('komisi')->where('idKaryawan', '=', $idKaryawan)->sum('gajiKomisi');
        return $total;
    }

}