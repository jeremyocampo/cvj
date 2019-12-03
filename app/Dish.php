<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    //

    use SoftDeletes;

    protected $guarded = [];


    public function item(){

        return $this->hasOne('App\Items', 'item_id', 'item_id');
    }
}
