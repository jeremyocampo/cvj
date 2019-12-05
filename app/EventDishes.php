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
    public function get_analogous_item($event_id){
        $itm = self::get_item();
        $a_budget = EventBudget::where('event_id','=',$event_id)->first();
        $budget_itm = EventBudgetItem::where('event_budget_id','=',$a_budget->id)->where('item_name','=',$itm->item_name)->first();
        return $budget_itm;
    }
}