<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = 'indicators';
    protected $primaryKey = 'id_indicator';
    protected $fillable = ['user_id','year_id','name','description','unit_measurement','data_type_id','minimum_value','expected_value','excellent_value','weighing','indicator_status_id','is_deleted','created_by','updated_by'];

    public function year(){
        return $this->belongsTo('App\Models\Year','year_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function data_type(){
        return $this->belongsTo('App\Models\Data_type','data_type_id');
    }

    public function indicator_status(){
        return $this->belongsTo('App\Models\Indicator_status','indicator_status_id');
    }

    public function indicator_score_log(){
        return $this->hasMany('App\Models\Indicator_score_log');
    }
}
