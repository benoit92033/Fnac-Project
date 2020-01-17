<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = "t_e_avis_avi";
    protected $primaryKey = 'avi_id';
    protected $fillable = ['avi_id', 'ach_id', 'mus_id', 'avi_date', 'avi_titre', 'avi_detail', 'avi_note', 'avi_nbutileoui', 'avi_nbutilenon'];
    public $timestamps = false;
}
