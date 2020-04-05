<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeEventSchedule;
use App\Employee;
use App\EventInventory;
use App\EventDishes;
use DB;

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
    public function reset_event_employees(){
        // Code goes here
        $event_scheds = EmployeeEventSchedule::where('event_id','=',$this->event_id)->get();

        foreach ($event_scheds as $event_sched){
            $event_sched->delete();
        }

        return true;
    }
    public function package(){
        // Code goes here
        return PackageModel::where('package_id','=',$this->package_id)->first();
    }
    public function client(){
        // Code goes here
        return Client::where('client_id','=',$this->client_id)->first();
    }


    public function reset_event_dish_cost_amount(){
        // Code goes here
        $event_dishes = EventDishes::where('event_id','=',$this->event_id)->get();

        foreach($event_dishes as $event_dish){
            $event_dish->cost_amount = null;
            $event_dish->save();
        }
        return true;
    }
    public function get_quotations(){
        // Code goes here
        return EventClientQuotation::where('event_id','=',$this->event_id)->get();
    }


    public function get_available_personnel_on_date($date){
        $employees = Employee::all();
        $avail_personnel = array();

        foreach($employees as $employee){
            $has_event = EmployeeEventSchedule::whereDate('event_date_time','=',$date)->where('employee_id','=',$employee->employee_id)->first();
            if($has_event == null){
                array_push($avail_personnel,$employee);
            }
        }
        return $avail_personnel;
    }
    public function save_client_quotation($file_path){
        $ecq = new EventClientQuotation();
        $ecq->event_id = $this->event_id;
        $ecq->version_num = count(EventClientQuotation::where('event_id','=',$this->event_id)->get()) + 1;
        $ecq->file_path = $file_path;
        $ecq->save();
    }
    public function is_event_package_compatible(){
        //will write criterion stuff.
        $package = PackageModel::where('package_id','=',$this->package_id)->first();
        if($this->totalpax > $package->suggested_pax || $this->event_type != $package->event_type){
            return -1;
        }

        return true;
    }
    public function has_outsource(){
        if (count(EventOutsourceInventory::where('event_id','=',$this->event_id)->get()) == 0 ){
            return false;
        }
        return true;
    }
    public function events_with_outsource(){
        $events = events::all();
        $returnArr = array();
        foreach($events as $event){
            if ($event->has_outsource() == true){
                array_push($returnArr,$event);
            }
        }
        return $returnArr;
    }
    public function outsource_quantity_created(){
        $eois = EventOutsourceInventory::where('event_id','=',$this->event_id)->get();
        $total = 0;
        foreach($eois as $eoi){
            $total += $eoi->get_quantity_created();
        }
        return $total;
    }
    public function get_po_total_amt(){
        $total = 0;
        $existing_pos = PurchaseOrderNew::where('event_id','=',$this->event_id)->get();
        foreach($existing_pos as $po){    
           $total += $po->total();
        } 
        
        return $total;
    }
    public function outsource_quantity_required(){
        return EventOutsourceInventory::where('event_id','=',$this->event_id)->sum('quantity');
        //    return EventOutsourceInventory::where('event_id','=',$this->event_id)->sum('quantity');
    }
    public function discard_package(){
        //removes event_inventory and event_dishes
        $e_inventories = EventInventory::where('event_id','=',$this->event_id)->get();
        $e_dishes = EventDishes::where('event_id','=',$this->event_id)->get();
        foreach($e_inventories as $e_inventory){
            $e_inventory->delete();
        }
        foreach ($e_dishes as $e_dish){
            $e_dish->delete();
        }
        $this->package_id = null;
        $this->total_amount_due = null;
        $this->off_premise_amount = null;
        $this->save();

        return true;
    }
    public function get_employees(){
        // Code goes here
        $employee_event_scheds = EmployeeEventSchedule::where('event_id','=',$this->event_id)->select('employee_id')->get();
        $emps = Employee::whereIn('employee_id',$employee_event_scheds)->get();

        return $emps;
    }
    public function get_analogous_event_model(){
        //uses latest with highest similarity score regarding items.
        //if no analogous got perfect score. what to do??
        //OPTIONS:
        // 1. dont use analogous method. (use fixed instead)
        // 2. use partial analogous method. partials filled by fixed (other items will use fixed method)
        // 3. use analogous on items instead of package. Search other nearest packages regardless of pax/event_type and calculate cost price of each multiplied by current pax.

        //include only those confirmed event.
        $events_past = events::where('event_id','!=',$this->event_id)->
                               where('package_id','=',$this->package_id)->
                               where('status','>',3)->get()->reverse();
        //status should be more than 3.g

        if(count($events_past) != 0){
            //check individual packages for event and check the selected if they have the match including additionals.
            //$event_score_arr = array();
            $highest_score = 0;
            $highest_score_event = 0;
            foreach($events_past as $event_past){
                $curr_score = 0;
                $event_past_dishes = EventDishes::where('event_id','=',$event_past->event_id)->select('item_id')->get();
                $event_dishes = EventDishes::where('event_id','=',$this->event_id)->select('item_id')->get();
                foreach($event_dishes as $event_dish){
                    if(in_array($event_dish,$event_past_dishes)){
                        $curr_score++;
                    }
                }
                if($highest_score<$curr_score){
                    $highest_score = $curr_score;
                    $highest_score_event= $event_past;
                }
                if($highest_score == count($event_dishes)){
                    return $highest_score_event;
                }
            }
            return $highest_score_event;
        }
        return null;
    }

    public function get_analogous_ind_event_models($item_id){

        //include only those confirmed event.

        $package = events::where('event_id','=',$this->event_id)->first()->package();
        $events = array();
        error_log('$package'.$package->package_name);

        $events_past = events::where('event_id','!=',$this->event_id)->
        where('status','>',1)->
        where('package_id','=',$package->package_id)->
        get()->reverse();

        error_log('past_events: '.count($events_past));
        //status should be more than 3.
        $ctr =0;
        foreach($events_past as $event){
            if($event->get_event_dish_from_item_id($item_id) != null){
                if($ctr < 3){
                    error_log('itm: '.$event);
                    array_push($events,$event);
                }
                $ctr++;
            }
        }
        return $events;
    }
    public function get_event_dish_from_item_id($item_id){
        return EventDishes::where('item_id','=',$item_id)->where('event_id','=',$this->event_id)->first();
    }
    public function set_default_cost_amount(){
        $event_dishes = EventDishes::where('event_id','=',$this->event_id)->get();
        $event_package = $this->package();

        foreach($event_dishes as $event_dish){
            $event_dish_item =  $event_dish->get_item();
            $event_dish->cost_amount = $event_dish_item->unit_expense * $event_package->suggested_pax;
            $event_dish->save();
        }
    }
    public function get_event_costing_models(){
        return EventCostingModel::where('event_id','=',$this->event_id)->get();
    }
    public function generate_avail_costing_models(){
        $old_ecms = EventCostingModel::where('event_id','=',$this->event_id)->get();
        if(count($old_ecms)==0){
            $default_ecm = new EventCostingModel();
            $default_ecm->event_id = $this->event_id;
            $default_ecm->model_name = null;
            $default_ecm->model_desc = 'Fixed Estimation';
            $default_ecm->save();

            $analog_ecm = new EventCostingModel();
            $analog_ecm->event_id = $this->event_id;
            $analog_ecm->model_name = 'analogous';
            $analog_ecm->model_desc = 'Analogous Estimation';
            $analog_ecm->save();
        }
        /*
        foreach($old_ecms as $ecm){
            if($ecm->model_name !='default'){
                $ecm->delete();
            }
        }
        //analogous if avail.
        //$is_analogous = $this->get_analogous_event_model();
        //if($is_analogous){
        $analog_ecm = new EventCostingModel();
        $analog_ecm->event_id = $this->event_id;
        $analog_ecm->model_name = 'analogous';
        $analog_ecm->model_desc = 'Analogous Estimation';
        $analog_ecm->save();
        //}
        */

        return true;
    }
    public function is_need_outsource(){
        $event_inventories = DB::select('select inventory_id, sum(qty) as qty from event_inventory where event_id = ? group by inventory_id',[$this->event_id]);
        foreach ($event_inventories as $inventory){
            $inv = inventory::where('inventory_id','=',$inventory->inventory_id)->first();
            $inventory->inventory_name = $inv->inventory_name;
            $inventory->unit_expense = $inv->acquisition_cost/$inv->shelf_life;

            $outsource_val = $inv->is_need_outsource_on_date($this->event_start,$inventory->qty);

            if($outsource_val != -1 ){
                return 1;
            }
        }
        return 0;
    }
    public function event_budget_create(){
        //create a budget.
        //$event_package = $this->package();
        //$is_analogous = $this->get_analogous_event_model() != null;
        $budget = new EventBudget();
        $budget->event_id = $this->event_id;
        $budget->total_budget = 0;
        $budget->save(); //still no buffer in budget.

        $event_dishes = EventDishes::where('event_id','=',$this->event_id)->get();
        $event_outsource_invs = EventOutsourceInventory::where('event_id','=',$this->event_id)->get();
        foreach ($event_dishes as $event_dish){
            $event_dish_item =  $event_dish->get_item();
            $budget_item = new EventBudgetItem();
            $budget_item->event_budget_id = $budget->id;
            $budget_item->item_name = $event_dish_item->item_name;

            $budget_item->actual_amount = 0;
            $budget_item->item_tag = "Food";
            $budget_item->budget_amount = $event_dish->cost_amount;

            /*
            if($this->costing_method == null){
                $budget_item->budget_amount = $event_dish_item->unit_expense * $event_package->suggested_pax;
            }
            else{
                $budget_item->budget_amount = $event_dish->cost_amount;
                //think about analingus later.
            }*/

            $budget_item->save();
            $budget->total_budget += $budget_item->budget_amount;
        }
        foreach ($event_outsource_invs as $outsource_inv){
            $inv = inventory::where('inventory_id','=',$outsource_inv->inventory_id)->first();

            $budget_item = new EventBudgetItem();
            $budget_item->event_budget_id = $budget->id;
            $budget_item->item_name = $inv->inventory_name;

            $budget_item->actual_amount = 0;
            $budget_item->item_tag = "Outsource";
            $budget_item->budget_amount = $outsource_inv->total_price;

            $budget_item->save();
            $budget->total_budget += $budget_item->budget_amount;
        }

        $budget->save();
        /*   //sub item_implementation.
        //create food item
        $budget_item = new EventBudgetItem();
        $budget_item->event_budget_id = $budget->id;
        $budget_item->item_name = "Food";
        $budget_item->budget_amount = 0;
        $budget_item->actual_amount = 0;
        $budget_item->save();
        //load foods
        foreach ($event_dishes as $event_dish){
            $event_dish_item =  $event_dish->get_item();
            $event_budget_subitem = new EventBudgetSubItem();
            $event_budget_subitem->item_name = $event_dish_item->item_name;
            if($is_analogous == false){
                $event_budget_subitem->budget_amount = $event_dish_item->unit_expense * $event_package->suggested_pax;
            }
            else{
                //think about analingus later.
            }
            $event_budget_subitem->actual_amount = 0;
            $budget_item->budget_amount += $event_budget_subitem->budget_amount;
            $event_budget_subitem->save();
        }
        */
        //save
    }
}
