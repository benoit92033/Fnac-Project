<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoris extends Model
{
    protected $table = "t_j_favori_fav";
    protected $primaryKey = ['ach_id', 'mus_id'];
    public $timestamps = false;
    public $incrementing = false;
}
