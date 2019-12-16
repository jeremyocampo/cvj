<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
class inventory extends Model
{
    //
    public $primaryKey = 'id';
    //public $incrementing = false;
    public $table = 'inventory';
    public $timestamps = false;
    public $fillable = [
    	'itemName', 'category','quantity', 'sku', 'date_created', 'last_modified'
    ];
    public function category(){
        return categoryRef::where('category_no','=',$this->category)->first();
    }

    public function is_need_outsource_on_date($date, $qty_asked){
        // Function returns -1 if there is no need to outsource on that date.
        // Will return the amount needed to outsource otherwise.

        $cur_inv = $this->inv_level_on_date($date) - $qty_asked;
        if($cur_inv >= 0){
            return -1;
        }
        return $cur_inv;
    }
    public function inv_level_on_date($date){
        $qty_used = 0;
        $date_format = new DateTime($date);
        $date_format = $date_format->format('Y-m-d');
        $events = events::whereDate('event_start','=',$date_format)->where('status','>',1)->get();
        error_log($date."---eeeeeventss: ".$events);
        foreach($events as $event){
            $event_inventories = EventInventory::
            where('inventory_id','=',$this->inventory_id)->
            where('event_id','=',$event->event_id)->get();
            foreach($event_inventories as $einv){
                $qty_used += $einv->qty;
            }
        }
        $curr_deployed_invs = deployed_inventory::where('inventory_deployed','=',$this->inventory_id)->whereDate('date_deployed','=',date('Y-m-d'))->get();
        $tot_deployed = 0;

        foreach($curr_deployed_invs as $inv){
            $tot_deployed += $inv->quantity;
        }

        return ($tot_deployed + $this->quantity) - $qty_used;
    }
}
