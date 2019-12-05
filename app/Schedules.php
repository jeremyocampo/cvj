<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedules extends Model
{
    //

    protected $guarded = [];

    public function manpower(){
        return $this->hasOne('App\Manpower');
    }
}
