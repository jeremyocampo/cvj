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
    public function is_event_package_compatible(){
        //will write criterion stuff.
        $package = PackageModel::where('package_id','=',$this->package_id)->first();
        if($this->totalpax > $package->suggested_pax || $this->event_type != $package->event_type){
            return false;
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
}
