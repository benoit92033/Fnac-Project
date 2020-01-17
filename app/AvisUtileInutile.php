<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisUtileInutile extends Model
{
    protected $table = "t_j_avisutile_avu";
    protected $primaryKey = ['avi_id', 'ach_id'];
    public $timestamps = false;
    public $incrementing = false;
}
