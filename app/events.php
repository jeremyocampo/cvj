<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeEventSchedule;
use App\Employee;
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
    public function reset_event_contents(){
        // Code goes here
        $p_inventories = PackageInventory::where('package_id','=',$this->package_id)->get();
        $p_items = PackageItem::where('package_id','=',$this->package_id)->get();
        foreach($p_inventories as $p_inventory){
            $p_inventory->delete();
        }
        foreach ($p_items as $p_item){
            $p_item->delete();
        }

        return true;
    }
    public function get_employees(){
        // Code goes here
        $employee_event_scheds = EmployeeEventSchedule::where('event_id','=',$this->event_id)->select('employee_id')->get();
        $emps = Employee::whereIn('employee_id',$employee_event_scheds)->get();

        return $emps;
    }
}
