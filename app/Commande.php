<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = "t_e_achat_aca";
    protected $primaryKey = 'aca_id';
    protected $fillable = ['cab_id', 'ach_id', 'aca_date','mag_id'];
    public $timestamps = false;
}
