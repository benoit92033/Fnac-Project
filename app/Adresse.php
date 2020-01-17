<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $table = "t_e_adresse_adr";
    protected $primaryKey = "adr_id";
    public $timestamps = false;
    protected $fillable = ['ach_id', 'adr_id', 'adr_nom', 'adr_type', 'adr_rue', 'adr_cp', 'adr_ville', 'pay_id',];
}
