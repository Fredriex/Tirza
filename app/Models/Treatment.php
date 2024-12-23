<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

Class Treatment{

    public function bacaTreatment(){
        $treatment = DB::table('treatment')->get();
        return $treatment;
    }

    public function simpanTreatment($x){
        DB::table('treatment')->insert([
            'idTreatment' => $x -> idTreatment,
            'namaTreatment' => $x -> namaTreatment,
            'hargaTreatment' => $x -> hargaTreatment,
            'hpp' => $x -> hpp
        ]);
    }

    public function gettreatment($idTreatment){
        $treatment = DB::table('treatment')->select('treatment.*')->where('idTreatment', '=', $idTreatment)->first();
        return $treatment;
    }

    public function edittreatment($idTreatment){
        DB::table('treatment')->where('idTreatment','=',$idTreatment->idTreatment)->update([
            'namaTreatment' => $idTreatment -> namaTreatment,
            'hargaTreatment' => $idTreatment -> hargaTreatment,
            'hpp' => $idTreatment -> hpp
        ]);
    }

    public function deletetreatment($idTreatment){
        DB::table('treatment')->where('idTreatment', '=', $idTreatment)->delete();
    }


}