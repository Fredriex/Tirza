<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Karyawan;
use App\Models\Treatment;
use App\Models\Transaksi;
use App\Models\detailTransaksi;
use App\Models\Komisi;
use App\Models\Gaji;
use App\Models\Pdf;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController{
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        return view('home', compact('user')); // Mengirim data user ke view
    }

//treatment~
    public function treatment(){
        $x = new Treatment();
        $hasil = $x->bacaTreatment();
        return view('treatment', ["treatment"=>$hasil]);
    }

    public function addtreatment(){
        return view('addtreatment');
    }

    public function savetreatment(Request $xx){
        $x = new Treatment();
        $x ->simpanTreatment($xx);
        $hasil = $x->bacaTreatment();
        return view('treatment', ["treatment"=>$hasil]);
    }

    public function edittreatment($idTreatment){
        $x = new Treatment();
        $hasil = $x -> gettreatment($idTreatment);
        return view('edittreatment', ["gettreatment" => $hasil]);
    }

    
    public function changetreatment(Request $xx){
        $x =  new Treatment();
        if(isset($xx->simpan)){
            $x->edittreatment($xx);
        }

        if(isset($xx->hapus)){
            $x->deletetreatment($xx->idTreatment);
        }

        $hasil = $x->bacaTreatment();
        return view ('treatment',["treatment"=>$hasil]);
    }

// karyawan
    public function karyawan(){
        $x = new Karyawan();
        $hasil = $x->bacaKaryawankomisi();
        return view('karyawan', ["karyawan" => $hasil]);
    }

    public function addkaryawan(){
        return view('addkaryawan');
    }

    public function savekaryawan(Request $xx){
        $x = new Karyawan();
        $x ->simpankaryawan($xx);
        $hasil = $x->bacaKaryawankomisi();
        return view('karyawan', ["karyawan"=>$hasil]);
    }

    public function editkaryawan($idKaryawan){
        $x = new Karyawan();
        $hasil = $x -> getkaryawan($idKaryawan);
        return view('editkaryawan', ["getkaryawan" => $hasil]);
    }

    
    public function changekaryawan(Request $xx){
        $x =  new Karyawan();
        if(isset($xx->simpan)){
            $x->editkaryawan($xx);
        }

        if(isset($xx->hapus)){
            $x->deletekaryawan($xx->idKaryawan);
        }

        $hasil = $x->bacaKaryawankomisi();
        return view ('karyawan',["karyawan"=>$hasil]);
    }


//transaksi
    public function transaksi(){
        $x = new Treatment();
        $y = new Karyawan();
        $treatment = $x -> bacaTreatment();
        $treatment2 = DB::table('treatment')->select('idTreatment', 'namaTreatment', 'hargaTreatment')->get();
        $karyawan = $y -> bacaKaryawan();
        return view('transaksi', ["treatment" => $treatment,"treatment2" => $treatment2, "karyawan" => $karyawan]);
    }


    public function savetransaksi(Request $request) {
        $idTransaksi = $request->input('idTransaksi');
        $tanggal = $request->input('tanggal');
        $namaCustomer = $request->input('namaCustomer');
        $total = $request->input('total');
    
        DB::table('transaksi')->insert([
            'idTransaksi' => $idTransaksi,
            'tanggal' => $tanggal,
            'namaCustomer' => $namaCustomer,
            'total' => $total
        ]);
    
        $idTreatmentList = $request->input('idTreatment');
        $idKaryawanList = $request->input('idKaryawan');
        $qtyList = $request->input('qty');
        $subtotalList = $request->input('subtotal');
    
        for ($i = 0; $i < count($idTreatmentList); $i++) {
            $subtotal = $subtotalList[$i];
            $komisi = $subtotal * 0.1;
            $tanggal = $tanggal;
            DB::table('detailtransaksi')->insert([
                'idTransaksi' => $idTransaksi,
                'idTreatment' => $idTreatmentList[$i],
                'idKaryawan' => $idKaryawanList[$i],
                'qty' => $qtyList[$i],
                'subtotal' => $subtotal
            ]);
            DB::table('detailgaji')->insert([
                'idTransaksi' => $idTransaksi,
                'idTreatment' => $idTreatmentList[$i],
                'idKaryawan' => $idKaryawanList[$i],
                'qty' => $qtyList[$i],
                'subtotal' => $subtotal
            ]);
            DB::table('komisi')->insert([
                'idTransaksi' => $idTransaksi,
                'idKaryawan' => $idKaryawanList[$i],
                'gajiKomisi' => $komisi,
                'tanggal' => $tanggal
            ]);
        }
        return redirect('/dataTransaksi'); 
    }
    
    
    public function dataTransaksi(){
        
        $x = new Transaksi();
        $hasil = $x -> bacatransaksi();
        return view('datatransaksi', ["dataTR" => $hasil]);
    }

        
    public function detail($idTransaksi){
        $x = new detailTransaksi();
        $hasil = $x -> detail($idTransaksi); 
        $hasil2 = $x-> grandtot($idTransaksi);
        $hasil3 = $x-> detailCustomer($idTransaksi);
        return view('detailtransaksi',["detail" => $hasil, "grandtot" => $hasil2, "customer" => $hasil3]);
    }

    public function komisi(){
        $x = new Komisi();
        $hasil = $x->bacakomisi();
        return view('komisi', ["gaji" => $hasil]);
    }

    public function komisikaryawan($idKaryawan){
        $x = new Komisi();
        $hasil = $x->hitungkomisi($idKaryawan);
        return view('penggajian', ["komisi" => $hasil]);
    }

    public function resetkomisi(){
        $x = new Karyawan();
        $x -> resetkomisi();
        $hasil = $x->bacaKaryawankomisi();
        return view('karyawan', ["karyawan" => $hasil]);
    }

    public function gaji($idKaryawan){
        $x = new Gaji();
        $hasil = $x->detailKaryawan($idKaryawan);
        $hasil2 = $x->detailgaji($idKaryawan);
        $hasil3 = $x->totalgaji($idKaryawan);
        return view ('gaji', ["gaji" => $hasil, "gajikomisi" => $hasil2, "totalgaji" => $hasil3]);
    }

    public function pdf($idTransaksi){
        $x = new Pdf();
        $hasil = $x->detailPdf($idTransaksi);
        $hasil2 = $x->grandtotPdf($idTransaksi);
        $hasil3 = $x->detailCustomerPdf($idTransaksi);
        return view('pdf',["detail" => $hasil, "grandtot" => $hasil2, "customer" => $hasil3]);
    }

    public function slipgaji($idKaryawan){
        $x = new Pdf();
        $hasil = $x->detailKaryawanPdf($idKaryawan);
        $hasil2 = $x->detailgajiPdf($idKaryawan);
        $hasil3 = $x->totalgajiPdf($idKaryawan);
        return view('slipgaji', ["karyawan" => $hasil, "detailGaji" =>$hasil2, "totalGaji" => $hasil3]);
    }

}
