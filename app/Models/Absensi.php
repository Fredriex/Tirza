<?php
namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Absensi{

    public function bacaAbsensi(){
        $absensi = DB::table('absensi')
        ->join('karyawan', 'absensi.idKaryawan', '=', 'karyawan.idKaryawan')
        ->join('statusabsensi', 'absensi.idStatus', '=', 'statusabsensi.idStatus')
        ->get();
        return $absensi;
    }

    public function bacaKaryawan(){
        $karyawan = DB::table('karyawan')->where('status', '=', 'aktif')
        ->get();
        return $karyawan;
    }

    public function bacastatus(){
        $status = DB::table('statusabsensi')
        ->get();
        return $status;
    }

    public function saveAbsensi($x){
        DB::table('absensi')->insert([
            'idAbsen' => $x -> idAbsen,
            'idKaryawan' => $x -> idKaryawan,
            'tanggalmasuk' => $x -> tanggalmasuk,
            'jam' => $x -> jam,
            'idStatus' => $x -> kehadiran
        ]);
    }


}