<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = "t_e_musique_mus";
    protected $primaryKey = "mus_id";
    public $timestamps = false;
}
