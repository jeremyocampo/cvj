<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class inventory extends Model
{
    //

    use SoftDeletes;

    public $primaryKey = 'inventory_id';
    //public $incrementing = false;
    public $table = 'inventory';
    public $timestamps = false;
    public $fillable = [
    	'itemName', 'category','quantity', 'sku', 'date_created', 'last_modified'
    ];
}
