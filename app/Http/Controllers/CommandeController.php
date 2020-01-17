<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rayon;
use App\Genre;
use App\Commande;
use App\LigneCommande;
use App\Panier;

class CommandeController extends Controller
{
    public function commande() {
        $id = Auth::user()->ach_id;
        $user = Auth::user();

        $panier = Panier::all()->where("ach_id", "=", $id)->toArray();
        $commande = Commande::create([
            'ach_id' => $id,
            'aca_date' => date('Y-m-d H:i:s'),
            'cab_id' => 5,
            'mag_id' => $user->mag_id
        ]);

        foreach($panier as $musique){
            LigneCommande::create([
                    'mus_id' => $musique["mus_id"],
                    'aca_id' => $commande->aca_id,
                    'lea_quantite' => $musique["qte"]
                ]);
        }

        Panier::query()->where("ach_id", "=", $id)->delete();
            
        return view("panier", [
            "messageCommande" => "Votre commande a été enregistrée",
            "results" => []
        ]);
    }
}