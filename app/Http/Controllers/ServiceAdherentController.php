<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\LigneCommande;

class ServiceAdherentController extends Controller
{
    public function index(Request $request) {

		$jour = date('d');
		$jour = $jour-'01';
		$date = date('Y')."-".date('m')."-".$jour;

		if(isset($request->preparee)){
			Commande::query()
				->where('aca_id', '=', $request->cmd)
				->update(['aca_preparee' => true]);
    	}

		$commandes = Commande::select('aca_id', 'aca_preparee', 'aca_date', 'ach_pseudo', 'mag_nom', 'rel_nom', 'adr_rue', 'adr_cp', 'adr_ville')
			->join('t_e_acheteur_ach', 't_e_acheteur_ach.ach_id', '=', 't_e_achat_aca.ach_id')
			->leftjoin('t_e_adresse_adr', 't_e_adresse_adr.adr_id', '=', 't_e_achat_aca.adr_id')
			->leftjoin('t_r_magasin_mag', 't_r_magasin_mag.mag_id', '=', 't_e_achat_aca.mag_id')
			->leftjoin('t_e_relais_rel', 't_e_relais_rel.rel_id', '=', 't_e_achat_aca.rel_id')
			->where("aca_date", '=', $date)
			->get()
			->toArray();

   		$commandesCompletes = [];
    	foreach ($commandes as $commande) {
    		$lignesCommandes = LigneCommande::select('lea_quantite', 'mus_titre')
				->join('t_e_musique_mus', 't_e_musique_mus.mus_id', '=', 't_j_ligneachat_lea.mus_id')
				->where("aca_id", '=', $commande["aca_id"])
				->get()
				->toArray();
    		$commande["lignesCommandes"] = $lignesCommandes;
    		$commandesCompletes[] = $commande;
    	}

        return view('serviceAdherent', [
            "commandes" => $commandesCompletes,
            "preparee" 
        ]);
    }
}
