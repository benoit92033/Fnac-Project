<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $table = "t_j_ligneachat_lea";
    protected $primaryKey = ['aca_id', 'mus_id'];
    protected $fillable = ['aca_id', 'mus_id', 'lea_quantite'];
    public $timestamps = false;
    public $incrementing = false;
}
