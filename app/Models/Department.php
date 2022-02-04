<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id_department';

    public function job(){
        return $this->hasMany('App\Models\Job');
    }

    public function user(){
        return $this->hasMany('App\User');
    }
}
