<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    public $table = 'items';
    public $timestamps = false;

    public $fillable = [
    	'item_name', 'quantity','quantity', 'unit_cost', 'unit_expense', 'item_image'
    ];
}
