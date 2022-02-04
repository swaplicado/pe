<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator_status extends Model
{
    protected $table = 'sys_indicator_status';
    protected $primaryKey = 'id_indicator_status';

    public function indicator(){
        return $this->hasMany('App\Models\Indicator');
    }

    public function indicator_status_log(){
        return $this->hasMany('App\Models\Indicator_status_log');    
    }
}
