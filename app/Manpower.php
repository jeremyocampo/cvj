<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manpower extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    public function agency(){

        return $this->belongsTo('App\Agency', 'agency_id', 'agency_id');
    }

    public function schedule()
    {

        return $this->belongsTo('App\Schedules', 'schedule_id');
    }
}
