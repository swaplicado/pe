<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator_status_log extends Model
{
    protected $table = 'indicator_status_log';
    protected $primaryKey = 'id_log';

    public function year(){
        return $this->belongsTo('App\Models\Year','year_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function indicator_status(){
        return $this->belongsTo('App\Models\Indicator_status','indicator_status_id');    
    }
}
