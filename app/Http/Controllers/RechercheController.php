<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interprete;
use App\Music;
use App\Genre;
use App\Rayon;
use App\Favoris;
use App\Avis;
use App\User;
use App\Panier;
use App\Commande;
use App\LigneCommande;

class RechercheController extends Controller
{
    public function index() {
        return view("recherche", [
            "rayons" => Rayon::all()->toArray(),
            "genres" => Genre::all()->toArray(),
            "genreSelect" => ""
        ]);
    }

    public function recherche(Request $request) {
        if ($request->recherche || $request->rayon || $request->genre) {
            $results = [];
            $noResult = true;
            if ($request->recherche) {
                $musiques = Music::query()
                    ->join('t_j_interpretemusique_inn', 't_e_musique_mus.mus_id', '=', 't_j_interpretemusique_inn.mus_id')
                    ->get()
                    ->toArray();
                $interpretes = Interprete::all()->toArray();
                foreach($musiques as $musique) {
                    foreach($interpretes as $interprete) {
                        if ($musique["inr_id"] == $interprete["inr_id"] &&
                            levenshtein(strtolower($interprete["inr_nom"]), strtolower($request->recherche))<2){
                                $results[] = $musique;
                                $noResult = false;
                            }
                    }
                }
            }
             else if ($request->genre) {
                $musiques = Music::query()
                    ->join('t_j_genremusique_gem', 't_e_musique_mus.mus_id', '=', 't_j_genremusique_gem.mus_id')
                    ->get()
                    ->toArray();
                $genres = Genre::all()->toArray();
                foreach($musiques as $musique) {
                    foreach($genres as $genre) {
                        if ($musique["gen_id"] == $genre["gen_id"] && $genre["gen_libelle"] == $request->genre){
                                $results[] = $musique;
                                $noResult = false;
                            }
                    }
                }
            }

            else if ($request->rayon){
                $musiques = Music::query()
                    ->join('t_j_rayonmusique_ram', 't_e_musique_mus.mus_id', '=', 't_j_rayonmusique_ram.mus_id')
                    ->get()
                    ->toArray();
                $rayons = Rayon::all()->toArray();
                foreach($musiques as $musique) {
                    foreach($rayons as $rayon) {
                        if ($musique["ray_id"] == $rayon["ray_id"] && $rayon["ray_nom"] == $request->rayon){
                                $results[] = $musique;
                                $noResult = false;
                            }
                    }
                }
            }
            
            $results = collect($results);
            if ($noResult) {
                return view("recherche", [
                    "noResults" => $request->recherche,
                    "rayons" => Rayon::all()->toArray(),
                    "genres" => Genre::all()->toArray(),
                    "genreSelect" => $request->genre
                ]);
            }
            else {
                if (auth()->check()){
                    $fav = Favoris::query()->select('t_j_favori_fav.mus_id')
                        ->join('t_e_musique_mus', 't_e_musique_mus.mus_id', '=', 't_j_favori_fav.mus_id')
                        ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','t_j_favori_fav.ach_id')
                        ->where('t_j_favori_fav.ach_id', '=', Auth::user()->ach_id)
                        ->get()
                        ->toArray();
                    $panier = Panier::query()->select('t_j_alerte_ale.mus_id')
                        ->join('t_e_musique_mus', 't_e_musique_mus.mus_id', '=', 't_j_alerte_ale.mus_id')
                        ->join('t_e_acheteur_ach','t_e_acheteur_ach.ach_id','t_j_alerte_ale.ach_id')
                        ->where('t_j_alerte_ale.ach_id', '=', Auth::user()->ach_id)
                        ->get()
                        ->toArray();

                    $musiquesAchetee = LigneCommande::select('mus_id')
                        ->join('t_e_achat_aca', 't_e_achat_aca.aca_id', '=', 't_j_ligneachat_lea.aca_id')
                        ->where('ach_id', '=', Auth::user()->ach_id)
                        ->get()->toArray();
                    $avisDeposes = Avis::all()
                        ->where('ach_id', '=', Auth::user()->ach_id)
                        ->toArray();
                    //var_dump($musiquesAchetee);var_dump($avisDeposes);die();
                }
                else {
                    $fav="";
                    $panier="";
                    $musiquesAchetee="";
                    $avisDeposes="";
                }

                return view("recherche", [
                    "results" => $results,
                    "rayons" => Rayon::all()->toArray(),
                    "favoris" => $fav,
                    "panier" => $panier,
                    "musiquesAchetee" => $musiquesAchetee,
                    "avisDeposes" => $avisDeposes,
                    "avis" => Avis::all()->toArray(),
                    "genres" => Genre::all()->toArray(),
                    "genreSelect" => $request->genre
                ]);
            }
    
        } else {
            return view("recherche", [
                "rayons" => Rayon::all()->toArray(),
                "genres" => Genre::all()->toArray(),
                "genreSelect" => ""
            ]);
        }
    } 
}
