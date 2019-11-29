<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class EventDishes extends Model
{

    public $timestamps = false;
    public $table = 'event_dishes';
    public $primaryKey = 'edishes_id';


    public function get_item(){
        return items::where('item_id','=',$this->item_id)->first();
    }
}