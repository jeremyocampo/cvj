<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deployed_inventory extends Model
{
    //
    protected $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    protected $table = 'deployed_inventory';
    public $timestamps = false;
    protected $fillable = [
        'event_deployed', 'inventory_deployed','qty', 'date_deployed', 'employee_assigned', 'barcode'
    ];
	
	public function event()
    {
        return $this->belongsTo('App\Event', 'event_deployed', 'event_id');
    }

    public function inventory()
    {
        return $this->belongsTo('App\inventory', 'inventory_deployed', 'inventory_id');
    }
}

