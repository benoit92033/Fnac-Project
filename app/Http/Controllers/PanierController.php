<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favoris;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rayon;
use App\Panier;
use App\Genre;

class PanierController extends Controller
{
    public function addMusique(Request $request) {
        $mus = $request->musique[0];
        $id = Auth::user()->ach_id;
        Panier::query()
            ->insert(['ach_id' => $id, 'mus_id' => $mus]);
            
        return view("recherche", [
            "rayons" => Rayon::all()->toArray(),
            "genres" => Genre::all()->toArray(),
            "genreSelect" => ""
        ]);
    }

    public function panier(Request $request) {

        if (isset($request->plus)){
            $qte = Panier::select('qte')
                ->where('ach_id', '=', Auth::user()->ach_id)
                ->where('mus_id', '=', $request->musique)
                ->get()
                ->toArray();
            
            $qte = $qte[0]["qte"] + 1;

            Panier::query('qte')
                ->where('ach_id', '=', Auth::user()->ach_id)
                ->where('mus_id', '=', $request->musique)
                ->update(['qte' => $qte]);
        }
        else if (isset($request->moins)){
            $qte = Panier::select('qte')
            ->where('ach_id', '=', Auth::user()->ach_id)
            ->where('mus_id', '=', $request->musique)
            ->get()
            ->toArray();
        
            $qte = $qte[0]["qte"] - 1;

            if($qte >= 1){
                Panier::query('qte')
                    ->where('ach_id', '=', Auth::user()->ach_id)
                    ->where('mus_id', '=', $request->musique)
                    ->update(['qte' => $qte]);
            }
        }

        $results = Panier::query()
            ->join('t_e_musique_mus', 't_e_musique_mus.mus_id', '=', 't_j_alerte_ale.mus_id')
            ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','t_j_alerte_ale.ach_id')
            ->where('t_j_alerte_ale.ach_id', '=', Auth::user()->ach_id)
            ->get();

        return view("panier", [
            "results" => $results
        ]);
    }
    
    public function delMusique(Request $request) {
        $mus = $request->musique[0];
        $id = Auth::user()->ach_id;
        Panier::query()
            ->where('ach_id','=', $id)
            ->where('mus_id','=', $mus)
            ->delete();
            
        return redirect("/panier");
    }

    public function delAllPanier() {
        $id = Auth::user()->ach_id;
        Panier::query()
            ->where('ach_id','=', $id)
            ->delete();
            
        return redirect("/panier");
    }
}