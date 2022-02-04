<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_type extends Model
{
    protected $table = 'sys_data_type';
    protected $primaryKey = 'id_data_type';
    
    public function indicator(){
        return $this->hasMany('App\Models\Indicator');
    }
}
