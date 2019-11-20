<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $primaryKey = 'event_name';
    //public $incrementing = false;
    public $table = 'event';
    public $timestamps = false;
    public $fillable = [
    	'reservation_id', 'client_id', 'event_date_time', 'event_type', 'theme', 'others', 'totalpax', 'package_id', 'pricehead', 'status', 'event_detailsAdded', 'inventory_id'
    ];
}