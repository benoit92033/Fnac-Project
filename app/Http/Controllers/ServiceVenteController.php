<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rayon;
use App\Music;
use App\RayonMusique;

class ServiceVenteController extends Controller
{
    public function index() {
        return view('serviceVente', [
            "musiques" => Music::all()->toArray()
        ]);
    }

    public function ajouterRayon(Request $request) {

        $rayon = Rayon::create(['ray_nom' => $request->ajouterRayon]);
        
        foreach($request->musiques as $musique){
            RayonMusique::create([
                'ray_id' => $rayon->ray_id,
                'mus_id' => $musique
            ]);
        }

        return view('serviceVente', [
            "msg" => "Rayon Ajouté !",
            "musiques" => Music::all()->toArray()
        ]);
    }

    public function ajouterPhoto(Request $request){
        $path = $request->file('image')->storeAs('public', $request->musique.'.jpg');
        $path = substr($path,7);
        Music::query()
            ->where('mus_id', '=', $request->musique)
            ->update(['mus_urlphoto' => $path]);

        return view('serviceVente', [
            "musiques" => Music::all()->toArray()
        ]);
    }
}
