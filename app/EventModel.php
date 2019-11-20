<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    //
    public $primaryKey = 'event_name';
    public $table = 'event';
    public $timestamps = false;
    public $fillable = [
        'event_name', 
        'reservation_id', 
        'client_id', 
        'event_date_time', 
        'event_type',
        'theme', 
        'centerpiece', 
        'flowers',
        'linencolor',
        'chair',
        'table',
        'others',
        'totalpax',
        'package_id',
        'priceperhead',
        'status'
    ];

}
