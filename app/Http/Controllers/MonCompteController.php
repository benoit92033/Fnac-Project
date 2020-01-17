<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\MonCompte;
use App\Magasin;
use App\JointureRelais;
use App\Relais;
use App\Adresse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MonCompteController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


   public function user_profil()
    {
        $user = User::find(Auth::user()->ach_id);

        $magasin = Magasin::query()
            ->where('t_r_magasin_mag.mag_id','=',$user->mag_id)
            ->get()
            ->toArray();

        $relais = JointureRelais::query()
            ->join('t_e_relais_rel','t_e_relais_rel.rel_id','=','t_j_relaisacheteur_rea.rel_id')
            ->where('t_j_relaisacheteur_rea.ach_id','=',$user->ach_id)
            ->get()
            ->toArray();

        $adresse = Adresse::query()
            ->where('ach_id','=',$user->ach_id)
            ->get()
            ->toArray();

        if($user->ach_telfixe != null){
           return view("MonCompte",[
                "nom" => $user->ach_nom,
                "prenom" => $user->ach_prenom,
                "email" => $user->ach_mel,
                "pseudo" => $user->ach_pseudo,
                "civilite" => $user->ach_civilite,
                "telportable" => $user->ach_telportable,
                "telfixe" => $user->ach_telfixe,
                "magasin" => $magasin,
                "relais" => $relais,
                "adresse" => $adresse
            ]); 
        } else {
            return view("MonCompte",[
                "nom"=> $user->ach_nom,
                "prenom"=>$user->ach_prenom,
                "email"=>$user->ach_mel,
                "pseudo"=>$user->ach_pseudo,
                "civilite"=>$user->ach_civilite,
                "telportable"=>$user->ach_telportable,
                "magasin"=>$magasin,
                "relais" => $relais,
                "adresse" => $adresse
            ]);
        }
    }  

    public function edit(User $user)
    {    
        $user = User::find(Auth::user()->ach_id);

        $adresse = Adresse::query()
            ->where('ach_id', '=', $user->ach_id)
            ->get()
            ->toArray();
        $adr = $adresse[0]["adr_rue"];
        $cp = $adresse[0]["adr_cp"];
        $ville = $adresse[0]["adr_ville"];

        return view("modifierCompte",[
            "nom" => $user->ach_nom,
            "prenom" => $user->ach_prenom,
            "email" => $user->ach_mel,
            "telportable" => $user->ach_telportable,
            "telfixe" => $user->ach_telfixe,
            "adr" => $adr,
            "cp" => $cp,
            "ville" => $ville
        ]);
    }

    public function update(Request $data)
    {
        //var_dump(Auth::user()->ach_motpasse);var_dump(bcrypt($data['ach_motpasse']));die();
        //if (Auth::user()->ach_motpasse != bcrypt($data['ach_motpasse']))
          //  return redirect('/MonCompte');
          $test = $data->toArray();
        Validator::make($test, [
            'ach_motpasse' => 'required|string|min:6|confirmed',
            'ach_telportable' =>
                array(
                    'required', 'regex:/(06|07)[0-9]{8}/'),
            'ach_telfixe' => 'nullable|min:10|max:10',
            'ach_codePostal' => 
                array(
                    'required', 'regex:/^[0-9]{5}$/')
        ]);

        //------------------------------------------------------GEOLOCALISATION------------------------------------------------------
        $url = 'https://koumoul.com/s/geocoder/api/v1/coord?q=' . $data['ach_adresse']. "%20" .$data['ach_codePostal']. "%20" .$data['ach_ville'];
        $url = str_replace(' ', '%20', $url);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-type:application/json;charset=utf-8"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = (json_decode($response));

            $magasins = Magasin::all()->toArray();
            $distMin = 100000;
            foreach( $magasins as $mag ){
                $earth_radius = 6378137;
                $rlo1 = deg2rad($mag["mag_longitude"]);
                $rla1 = deg2rad($mag["mag_latitude"]);
                $rlo2 = deg2rad($response->lon);
                $rla2 = deg2rad($response->lat);
                $dlo = ($rlo2 - $rlo1) / 2;
                $dla = ($rla2 - $rla1) / 2;
                $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
                $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $distKM = ($earth_radius * $d)/1000;

                if ($distKM < $distMin) {
                    $distMin = $distKM;
                    $magasinLePlusProche = $mag["mag_id"];
                }
            }

            $relais = Relais::all()->toArray();
            $distMin = 100000;
            foreach( $relais as $relai ){
                $earth_radius = 6378137;
                $rlo1 = deg2rad($relai["rel_longitude"]);
                $rla1 = deg2rad($relai["rel_latitude"]);
                $rlo2 = deg2rad($response->lon);
                $rla2 = deg2rad($response->lat);
                $dlo = ($rlo2 - $rlo1) / 2;
                $dla = ($rla2 - $rla1) / 2;
                $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
                $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $distKM = ($earth_radius * $d)/1000;

                if ($distKM < $distMin) {
                    $distMin = $distKM;
                    $relaisLePlusProche = $relai["rel_id"];
                }
            }
        }
        //------------------------------------------------------GEOLOCALISATION------------------------------------------------------
        if ($data['ach_newmotpasse'] == null){
            $user = User::query()->update([
                'ach_nom' => $data['ach_nom'],
                'ach_prenom' => $data['ach_prenom'],
                'ach_telportable' => $data['ach_telportable'],
                'ach_telfixe' => $data['ach_telfixe'],
                'ach_motpasse' => bcrypt($data['ach_newmotpasse']),
                'mag_id' => $magasinLePlusProche
            ]);
        }

        else {
            $user = User::query()->update([
                'ach_nom' => $data['ach_nom'],
                'ach_prenom' => $data['ach_prenom'],
                'ach_telportable' => $data['ach_telportable'],
                'ach_telfixe' => $data['ach_telfixe'],
                'mag_id' => $magasinLePlusProche
            ]);
        }
        $id = Auth::user()->ach_id;

        Adresse::query()
            ->where('ach_id', '=', $id)
            ->update([
                'adr_nom' => ucfirst($data['ach_ville']),
                'adr_rue' => $data['ach_adresse'],
                'adr_cp' => $data['ach_codePostal'],
                'adr_ville' => ucfirst($data['ach_ville']),
            ]);

        JointureRelais::query()
            ->where('ach_id', '=', $id)
            ->update([
                'rel_id' => $relaisLePlusProche
            ]);

        return redirect('/MonCompte');
    }
}
 