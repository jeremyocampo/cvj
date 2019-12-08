<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class inventory extends Model
{
    //
<<<<<<< HEAD

    use SoftDeletes;

    public $primaryKey = 'inventory_id';
=======
    public $primaryKey = 'id';
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
    //public $incrementing = false;
    public $table = 'inventory';
    public $timestamps = false;
    public $fillable = [
    	'itemName', 'category','quantity', 'sku', 'date_created', 'last_modified'
    ];
}
