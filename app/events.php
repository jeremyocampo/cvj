<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeEventSchedule;
use App\Employee;
use App\EventInventory;
use App\EventDishes;
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
        //include only those confirmed event.
        $events_past = events::where('event_id','!=',$this->event_id)->
                               where('package_id','=',$this->package_id)->
                               where('status','=',2)->get()->reverse();
        if(count($events_past) != 0){
            return $events_past[0];
        }
        return null;
    }
    public function set_default_cost_amount(){
        $event_dishes = EventDishes::where('event_id','=',$this->event_id)->get();
        $event_package = $this->package();

        foreach($event_dishes as $event_dish){
            $event_dish_item =  $event_dish->get_item();
            $event_dish->cost_amount = $event_dish_item->unit_expense * $event_package->suggested_pax;;
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
        }
        foreach($old_ecms as $ecm){
            if($ecm->model_name !='default'){
                $ecm->delete();
            }
        }
        //analogous if avail.
        $is_analogous = $this->get_analogous_event_model();
        if($is_analogous){
            $analog_ecm = new EventCostingModel();
            $analog_ecm->event_id = $this->event_id;
            $analog_ecm->model_name = 'analogous';
            $analog_ecm->model_desc = 'Analogous Estimation';
            $analog_ecm->save();
        }

        return true;
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
