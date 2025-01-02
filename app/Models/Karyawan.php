<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Karyawan{

    public function bacaKaryawan(){
        $karyawan = DB::table('karyawan')->where('status', '=', 'aktif')
        ->get();
        return $karyawan;
    }


    public function bacaKaryawankomisi(){
        $karyawan = DB::table('karyawan')->where('status', '=', 'aktif')
        ->leftJoin('rekap_komisi', 'karyawan.idKaryawan', '=', 'rekap_komisi.idKaryawan')
        ->select('karyawan.idKaryawan', 
        'karyawan.namaKaryawan',
        'karyawan.noTelp',
        'karyawan.alamat',
        'karyawan.tanggalMasuk',
         'karyawan.gajiBulanan', 
         'rekap_komisi.totalKomisi',
         DB::raw('IFNULL(karyawan.gajiBulanan, 0) + IFNULL(rekap_komisi.totalKomisi, 0) as totalGajiBulanan'))
        ->get();
        return $karyawan;
    }

    public function simpankaryawan($x){
        DB::table('karyawan')->insert([
            'idKaryawan' => $x -> idKaryawan,
            'namaKaryawan' => $x -> namaKaryawan,
            'noTelp' => $x -> noTelp,
            'alamat' => $x -> alamat,
            'tanggalMasuk' => $x -> tanggalMasuk,
            'gajiBulanan' => $x -> gajiBulanan,
            
        ]);
    }

    public function getkaryawan($idKaryawan){
        $karyawan = DB::table('karyawan')->select('karyawan.*')->where('idKaryawan', '=', $idKaryawan)->first();
        return $karyawan;
    }

    public function editkaryawan($idKaryawan){
        DB::table('karyawan')->where('idKaryawan','=',$idKaryawan->idKaryawan)->update([
            'namaKaryawan' => $idKaryawan -> namaKaryawan,
            'noTelp' => $idKaryawan -> noTelp,
            'alamat' => $idKaryawan -> alamat,
            'tanggalMasuk' => $idKaryawan -> tanggalMasuk,
            'gajiBulanan' => $idKaryawan -> gajiBulanan
        ]);
    }

    public function deletekaryawan($idKaryawan){
        DB::table('karyawan')->where('idKaryawan', '=', $idKaryawan)->update(['status' => "non-aktif"]);
    }

    public function resetkomisi(){
        DB::table('rekap_komisi')->update(['totalKomisi' => 0]);
        DB::table('detailgaji')->delete();
    }

}