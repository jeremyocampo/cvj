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
        error_log('budget_event_id'.$event_id);
        $budget_itm = EventBudgetItem::where('event_budget_id','=',$a_budget->id)->where('item_name','=',$itm->item_name)->first();

        error_log('b itm:'.$budget_itm);
        return $budget_itm;
    }
    public function get_analogous_item_ind(){
        $package = events::where('event_id','=',$this->event_id)->package();

        $events_past = events::where('event_id','!=',$this->event_id)->
        where('package_id','=',$package->package_id)->
        where('status','>',1)->get()->reverse();

        //status should be more than 3.
        foreach($events_past as $event){
            if($event->get_event_dish_from_item_id($this->item_id) != null){
                $itm = self::get_item();
                $a_budget = EventBudget::where('event_id','=',$event->event_id)->first();
                $budget_itm = EventBudgetItem::where('event_budget_id','=',$a_budget->id)->where('item_name','=',$itm->item_name)->first();
                return $budget_itm;
            }
        }

        return null;
    }
}