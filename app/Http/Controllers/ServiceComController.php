<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AvisAbusif;
use App\Avis;

class ServiceComController extends Controller
{
    public function allAvisAbusif() {

        $avisAbusif = AvisAbusif::query()
            ->join('t_e_avis_avi','t_e_avis_avi.avi_id','=','t_j_avisabusif_ava.avi_id')
            ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','=','t_j_avisabusif_ava.ach_id')
            ->get()
            ->toArray();
        return view('serviceCom', [
            "avisAbusif" => $avisAbusif
        ]);
    }

    public function delAvisAbusif(Request $request) {
        AvisAbusif::query()->where('avi_id', '=', $request->avis[0])->delete();
        Avis::query()->where('avi_id', '=', $request->avis[0])->delete();

        $avisAbusif = AvisAbusif::query()
            ->join('t_e_avis_avi','t_e_avis_avi.avi_id','=','t_j_avisabusif_ava.avi_id')
            ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','=','t_j_avisabusif_ava.ach_id')
            ->get()
            ->toArray();
        return view('serviceCom', [
            "avisAbusif" => $avisAbusif
        ]);
    }
}
