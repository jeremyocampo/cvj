<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deployed_inventory extends Model
{
    //
    protected $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    protected $table = 'deployed_inventory';
    protected $timestamps = false;
    protected $fillable = [
    	'event_deployed', 'inventory_deployed','quantity', 'date_deployed', 'employee_assigned', 'barcode'
    ];
}
