<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator_score_log extends Model
{
    protected $table = 'indicator_scores_log';
    protected $primaryKey = 'id_score';

    public function indicator(){
        return $this->belongsTo('App\Models\Indicator','indicator_id');
    }
}
