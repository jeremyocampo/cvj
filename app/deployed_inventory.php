<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deployed_inventory extends Model
{
    //
    public $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    public $table = 'deployed_inventory';
    public $timestamps = false;
    public $fillable = [
    	'event_deployed', 'inventory_deployed','quantity', 'date_deployed', 'employee_assigned', 'barcode'
    ];
}
