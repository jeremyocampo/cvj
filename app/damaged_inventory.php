<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class damaged_inventory extends Model
{
    //
    protected $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    protected $table = 'deployed_inventory';
    public $timestamps = false;
    protected $fillable = [
        'event_deployed', 'inventory_deployed','qty', 'date_deployed', 'employee_assigned', 'barcode', 'reason'
    ];
}

