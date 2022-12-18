<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function follow(){
        return $this->belongsToMany('App\Student');
    }
};