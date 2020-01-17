<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favoris;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rayon;
use App\Genre;

class FavorisController extends Controller
{
    public function addFavori(Request $request) {
        $mus = $request->musique[0];
        $id = Auth::user()->ach_id;
        Favoris::query()
            ->insert(['ach_id' => $id, 'mus_id' => $mus]);
            
        return view("recherche", [
            "rayons" => Rayon::all()->toArray(),
            "genres" => Genre::all()->toArray(),
            "genreSelect" => ""
        ]);
    }

    public function favoris() {
        $results = Favoris::query()
            ->join('t_e_musique_mus', 't_e_musique_mus.mus_id', '=', 't_j_favori_fav.mus_id')
            ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','t_j_favori_fav.ach_id')
            ->where('t_j_favori_fav.ach_id', '=', Auth::user()->ach_id)
            ->get();

        return view("favoris", [
            "results" => $results
        ]);
    }
    
    public function delFavori(Request $request) {
        $mus = $request->musique[0];
        $id = Auth::user()->ach_id;
        Favoris::query()
            ->where('ach_id','=', $id)
            ->where('mus_id','=', $mus)
            ->delete();
            
        return redirect("/favoris");
    }
}
