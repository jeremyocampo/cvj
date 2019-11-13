<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    //
    public $primaryKey = 'inventory_id';
    //public $incrementing = false;
    public $table = 'inventory';
    public $timestamps = false;
    public $fillable = [
    	'itemName', 'category','quantity', 'sku', 'date_created', 'last_modified'
    ];
}
