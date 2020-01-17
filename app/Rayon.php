<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    protected $table = "t_r_rayon_ray";
    protected $primaryKey = "ray_id";
    protected $fillable = ['ray_nom', 'ray_id'];
    public $timestamps = false;
}
