<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //

    protected $table = "agency";

    protected $guarded = [];

    public function manpower()
    {
        return $this->hasOne('App\Manpower');
    }
}
