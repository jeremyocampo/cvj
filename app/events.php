<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    //
    public $primaryKey = 'event_id';
    public $table = 'event';
    public $timestamps = false;
    public $fillable = [
        'event_name', 
        'client_id', 
        'reservation_id', 
        'event_start', 
        'event_end',
        'event_type',
        'theme', 
        'others',
        'totalpax',
        'package_id',
        'status',
        'event_detailesAdded',
        'inventory_id',
        'client_id',
    ];
}
