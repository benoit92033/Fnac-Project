<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisAbusif extends Model
{
    protected $table = "t_j_avisabusif_ava";
    protected $primaryKey = ['avi_id', 'ach_id'];
    protected $fillable = ['avi_id', 'ach_id'];
    public $timestamps = false;
    public $incrementing = false;
}
