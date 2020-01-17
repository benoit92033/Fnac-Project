<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Magasin;
use App\JointureRelais;
use App\Relais;
use App\Adresse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ach_pseudo' => 'required|string|max:255',
            'ach_mel' => 'required|string|email|max:255|unique:t_e_acheteur_ach',
            'ach_motpasse' => 'required|string|min:6|confirmed',
            'ach_telportable' =>
                array(
                    'required', 'regex:/(06|07)[0-9]{8}/'),
            'ach_telfixe' => 'nullable|min:10|max:10',
            'ach_codePostal' => 
                array(
                    'required', 'regex:/^[0-9]{5}$/')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
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

        $user=User::create([
            'ach_pseudo' => $data['ach_pseudo'],
            'ach_nom' => $data['ach_nom'],
            'ach_prenom' => $data['ach_prenom'],
            'ach_civilite' => $data['ach_civilite'],
            'ach_telportable' => $data['ach_telportable'],
            'ach_telfixe' => $data['ach_telfixe'],
            'ach_mel' => $data['ach_mel'],
            'ach_motpasse' => bcrypt($data['ach_motpasse']),
            'mag_id' => $data['mag_id']
        ]);

        Adresse::create([
            'ach_id' => $user['ach_id'],
            'adr_nom' => ucfirst($data['ach_ville']),
            'adr_type' => 'Facturation',
            'adr_rue' => $data['ach_adresse'],
            'adr_cp' => $data['ach_codePostal'],
            'adr_ville' => ucfirst($data['ach_ville']),
            'pay_id' => 1
        ]);

        JointureRelais::create([
            'ach_id' => $user['ach_id'],
            'rel_id' => $relaisLePlusProche
        ]);

        return $user;
    }
}
