<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "t_e_acheteur_ach";
    public $timestamps = false;
    protected $primaryKey = "ach_id";

    //enlève l'erreur à la deconnexion (laravel essaie de base d'enregistrer une "remember_token" dans la DB)
    protected $rememberTokenName = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ach_mel', 'ach_motpasse', 'ach_pseudo', 'ach_civilite', 'ach_nom' , 'ach_prenom', 'ach_telfixe', 'ach_telportable', 'mag_id', 'rel_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ach_motpasse', 'remember_token',
    ];

    public function getAuthPassword() {
        return $this->ach_motpasse;
    }
    
}
