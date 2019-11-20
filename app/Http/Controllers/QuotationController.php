<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\EmployeeEventSchedule;
use App\Event;
use App\EventDishes;
use App\EventInventory;
use App\EventModel;
use App\events;
use App\inventory;
use App\Items;
use App\PackageInventory;
use App\PackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use Session;
use Illuminate\Support\Facades\Auth;
class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function client_quotation($event_id)
    {
        //inventory items //food items
        $client_id = Auth::id();
        $event = Event::where('event_id','=',$event_id)->first();
        $client = Client::where('client_id','=',$event->client_id)->first();
        $is_off_premise = $event->venue == "Off-Premise";
        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("g:i A", strtotime($event->event_start));
        $event->formatted_end = date("g:i A", strtotime($event->event_end));

        $package = PackageModel::where('package_id','>=',$event->package_id)->first();
        $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
        $food_items =$food_items->toArray();
        $package->foods = Items::whereIn('item_id',$food_items)->get();
        $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        $employees_id = EmployeeEventSchedule::where("event_id",'=',$event_id)->get();
        $total_staff_cost = 0;

        foreach($employees_id as $employee_id){
            $emp = Employee::where('employee_id','=',$employee_id)->first();
            $total_staff_cost += 800; //dummy calculation of wages per day or gig.
        }


        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;

        }
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        return view('client_quotation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,
                'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes, 'is_off_premise'=>$is_off_premise,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost]);
    }

    public function company_quotation($event_id)
    {
        //inventory items //food items
        $client_id = Auth::id();
        $event = Event::where('event_id','=',$event_id)->first();
        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("g:i A", strtotime($event->event_start));
        $event->formatted_end = date("g:i A", strtotime($event->event_end));

        $package = PackageModel::where('package_id','>=',$event->package_id)->first();
        $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
        $food_items =$food_items->toArray();
        $package->foods = Items::whereIn('item_id',$food_items)->get();
        $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        $employees_id = EmployeeEventSchedule::where("event_id",'=',$event_id)->get();
        $total_staff_cost = 0;

        foreach($employees_id as $employee_id){
            $emp = Employee::where('employee_id','=',$employee_id)->first();
            $total_staff_cost += 800; //dummy calculation of wages per day or gig.
        }

        error_log("cleint: ".$client);
        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;

        }
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        return view('company_quotation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,
                'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost]);
    }
}
