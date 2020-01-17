<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    //Je ne sais pas à quoi sert la table "Alerte", du coup je m'en sert pour faire mon panier puisqu'il n'y a pas de table "panier".
    protected $table = "t_j_alerte_ale";
    protected $primaryKey = ['mus_id', 'ach_id'];
    // protected $fillable = ['mus_id', 'ach_id'];
    public $timestamps = false;
    public $incrementing = false;
}
