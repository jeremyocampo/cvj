<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInventory extends Model
{

    public $timestamps = false;
    public $table = 'event_inventory';

    public $primaryKey = 'einventory_id';
}