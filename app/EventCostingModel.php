<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCostingModel extends Model
{
    protected $table = 'event_costing_model';

    public $timestamps = false;
    public $primaryKey = 'event_costing_id';
}
