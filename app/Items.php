<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    public $table = 'items';

    public $primaryKey = 'item_id';
    public $timestamps = false;

    public function dish(){

        return $this->belongsTo('App\Dish');
    }
}
