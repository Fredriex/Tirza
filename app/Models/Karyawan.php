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
        $karyawan = DB::table('karyawan')
            ->where('karyawan.status', '=', 'aktif')
            ->leftJoin('absensi', function($join) {
                $join->on('karyawan.idKaryawan', '=', 'absensi.idKaryawan')
                     ->whereMonth('absensi.tanggalmasuk', '=', DB::raw('MONTH(CURDATE())'))
                     ->whereYear('absensi.tanggalmasuk', '=', DB::raw('YEAR(CURDATE())'))
                     ->where('absensi.idStatus', '=', '1'); // Sesuaikan dengan idStatus yang menunjukkan hadir
            })
            ->leftJoin('rekap_komisi', 'karyawan.idKaryawan', '=', 'rekap_komisi.idKaryawan')
            ->select(
                'karyawan.idKaryawan', 
                'karyawan.namaKaryawan',
                'karyawan.noTelp',
                'karyawan.alamat',
                'karyawan.tanggalMasuk',
                'karyawan.gajiHarian', 
                'rekap_komisi.totalKomisi',
                DB::raw('COUNT(absensi.idAbsen) AS jumlah_hadir'),
                DB::raw('COALESCE(karyawan.gajiHarian, 0) * COUNT(absensi.idAbsen) AS totalGajiHarian'),
                DB::raw('COALESCE(karyawan.gajiHarian, 0) * COUNT(absensi.idAbsen) + COALESCE(rekap_komisi.totalKomisi, 0) AS totalGajiBulanan')
            )
            ->groupBy(
                'karyawan.idKaryawan', 
                'karyawan.namaKaryawan',
                'karyawan.noTelp',
                'karyawan.alamat',
                'karyawan.tanggalMasuk',
                'karyawan.gajiHarian', 
                'rekap_komisi.totalKomisi'
            )
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
            'gajiHarian' => $x -> gajiHarian,
            
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
            'gajiHarian' => $idKaryawan -> gajiHarian
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