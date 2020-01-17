<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RayonMusique extends Model
{
    protected $table = "t_j_rayonmusique_ram";
    protected $primaryKey = ['ray_id', 'mus_id'];
    protected $fillable = ['ray_id', 'mus_id'];
    public $timestamps = false;
    public $incrementing = false;
}
