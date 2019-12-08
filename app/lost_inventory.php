<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lost_inventory extends Model
{
    //
    protected $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    protected $table = 'lost_inventory';
    public $timestamps = false;
    protected $fillable = [
        'event_deployed', 'inventory_deployed','qty', 'date_deployed', 'employee_assigned', 'barcode', 'reason'
    ];
}
