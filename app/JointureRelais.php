<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JointureRelais extends Model
{
    protected $table = "t_j_relaisacheteur_rea";
    protected $primaryKey = ['rel_id', 'ach_id'];
    protected $fillable = ['rel_id', 'ach_id'];
    public $timestamps = false;
    public $incrementing = false;
}
