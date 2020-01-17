<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avis;
use App\Rayon;
use App\Music;
use App\User;
use App\AvisUtileInutile;
use App\AvisAbusif;

class AvisController extends Controller
{
    public function allAvis(Request $request) {
        $mus = $request->musique[0];
        $noResult = true;

        if (isset($request->recents))
            $request->negatif = null;

        if(isset($request->negatif)){
            $avis = Avis::query()
            ->select('*')
            ->where('t_e_avis_avi.mus_id', '=', $mus)
            ->orderBy('avi_note', 'asc')
            ->orderBy('avi_date', 'desc')
            ->get()->toArray();
        }

        else {
             $avis = Avis::query()
            ->select('*')
            ->where('t_e_avis_avi.mus_id', '=', $mus)
            ->orderBy('avi_date', 'desc')
            ->get()->toArray();
        }
    
        $mus = Music::query()
            ->select('*')
            ->where('t_e_musique_mus.mus_id', '=', $mus)
            ->get()
            ->toArray();

        $id = Auth::user()->ach_id;
        $avisDejaSignaler = AvisAbusif::all()->where('ach_id', '=', $id)->toArray();

        if(count($avisDejaSignaler)){
            foreach($avisDejaSignaler as $avisD){
                $idAvisDejaSignaler[] = $avisD["avi_id"];
            }
        }
        else $idAvisDejaSignaler = [];

        if (count($avis)) { 
            $noResult = false;
            return view("avis", [
                "avis" => $avis,
                "noResult" => $noResult,
                "musique" => $mus,
                "avisDejaSignaler" => $idAvisDejaSignaler
            ]);
        }

        else {
            return view("avis", [
                "noResult" => $noResult,
                "musique" => $mus
            ]);
        }
    }

    public function utileInutile(Request $request) {
        $avisId = $request->avisId;
        $id = Auth::user()->ach_id;

        $result = AvisUtileInutile::query()
            ->where('avi_id', '=', $avisId)
            ->where('ach_id', '=', $id)
            ->get();

        if(!count($result)) {
            if(isset($request->avisUtile))
            {
                $nbAvis = $request->nbAvisUtile;
                $avisUtilePlus = $nbAvis + 1;
                Avis::query()
                    ->where('avi_id', '=', $avisId)
                    ->update(['avi_nbutileoui' => $avisUtilePlus]);
                AvisUtileInutile::query()
                    ->insert(['avi_id' => $avisId, 'ach_id' => $id]);
            }
            else if(isset($request->avisInutile)) 
            {
                $nbAvis = $request->nbAvisInutile;
                $avisInutilePlus = $nbAvis + 1;
                Avis::query()
                    ->where('avi_id', '=', $avisId)
                    ->update(['avi_nbutilenon' => $avisInutilePlus]);
    
                AvisUtileInutile::query()
                    ->insert(['avi_id' => $avisId, 'ach_id' => $id]);
            }
        }

        return $this->allAvis($request);
    }

    public function avisAbusif(Request $request) {
        $idAvis = $request->avisId;
        $id = Auth::user()->ach_id;

        AvisAbusif::create(['avi_id' => $idAvis, 'ach_id' => $id]);

        return $this->allAvis($request);
    }

    public function formAddAvis(Request $request) {
        return view('formAjouterAvis', [
            "musique" => $request->musique
        ]);
    }

    public function addAvis(Request $request) {
        Avis::create([
            'ach_id' => Auth::user()->ach_id,
            'mus_id' => $request->musique,
            'avi_date' => date('Y-m-d H:i:s'),
            'avi_titre' => $request->titre,
            'avi_detail' => $request->desc,
            'avi_note' => $request->note,
            'avi_nbutileoui' => 0,
            'avi_nbutilenon' => 0
        ]);

        return $this->allAvis($request);
    }
}