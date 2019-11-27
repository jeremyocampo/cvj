<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\EmployeeEventSchedule;
use App\Event;
use App\EventDishes;
use App\EventInventory;
use App\EventModel;
use App\EventOutsourceItem;
use App\events;
use App\inventory;
use App\Items;
use App\OutsourcedItem;
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
        $add_inv_total = 0;
        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            $add_inv_total += $inventory->qty * $inventory->rent_price;
        }
        $add_dish_total = 0;
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
            $add_dish_total += $dish->total_price;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        error_log("dish: ".$add_dish_total);
        error_log("inv: ".$add_inv_total);
        return view('client_quotation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,
                'additional_count'=>$additional_count,'add_dish_total'=>$add_dish_total,'add_inv_total'=>$add_inv_total,
                'additional_dishes'=>$event_dishes, 'is_off_premise'=>$is_off_premise,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost]);
    }
    public function client_reservation($event_id)
    {
        //inventory items //food items
        $client_id = Auth::id();

        $event = Event::where('event_id','=',$event_id)->first();
        $client = Client::where('client_id','=',$event->client_id)->first();

        $is_off_premise = $event->venue == "Off-Premise";
        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("g:i A", strtotime($event->event_start));
        $event->formatted_end = date("g:i A", strtotime($event->event_end));
        $event->day_name = date("l", strtotime($event->event_start));

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
        $add_inv_total = 0;
        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            $add_inv_total += $inventory->qty * $inventory->rent_price;
        }
        $add_dish_total = 0;
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
            $add_dish_total += $dish->total_price;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        error_log("dish: ".$add_dish_total);
        error_log("inv: ".$add_inv_total);
        return view('client_reservation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,
                'additional_count'=>$additional_count,'add_dish_total'=>$add_dish_total,'add_inv_total'=>$add_inv_total,
                'additional_dishes'=>$event_dishes, 'is_off_premise'=>$is_off_premise,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost]);
    }

    public function company_quotation($event_id)
    {
        //inventory items //food items
        $client_id = Auth::id();

        $event = Event::where('event_id','=',$event_id)->first();
        $client = Client::where('client_id','=',$event->client_id)->first();

        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("g:i A", strtotime($event->event_start));
        $event->formatted_end = date("g:i A", strtotime($event->event_end));
        $event->day_name = date("D", strtotime($event->event_start));

        $total_dish_cost = 0;
        $total_inv_cost = 0;
        $total_staff_cost = 0;
        $total_outsource_cost = 0;
        $extra_cost = 4000;

        $is_off_premise = $event->venue == "Off-Premise";
        $outsourced_items = EventOutsourceItem::where('event_id','=',$event->event_id)->get();

        $package = PackageModel::where('package_id','>=',$event->package_id)->first();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        $employees_id = EmployeeEventSchedule::where("event_id",'=',$event_id)->select('employee_id')->get();

        $employees = Employee::whereIn('employee_id',$employees_id)->get();
        foreach($employees_id as $employee_id){
            $emp = Employee::where('employee_id','=',$employee_id)->first();
            $total_staff_cost += 800; //dummy calculation of wages per day or gig.
            //array_push($employees, $emp);
        }
        foreach ($event_inventories as $inventory){
            $inv = inventory::where('inventory_id','=',$inventory->inventory_id)->first();
            $inventory->inventory_name = $inv->inventory_name;
            $inventory->unit_expense = $inv->acquisition_cost/$inv->shelf_life;

            $total_inv_cost += $inventory->unit_expense * $inventory->qty;
        }
        foreach ($event_dishes as $dish){
            $itm = Items::where('item_id','=',$dish->item_id)->first();
            $dish->item_name = $itm->item_name;
            $dish->unit_expense = $itm->unit_expense;

            $total_dish_cost += $dish->unit_expense * $package->suggested_pax;
        }
        foreach($outsourced_items as $outsourced_item){
            $out_item = OutsourcedItem::where('outsourced_item_id','=',$outsourced_item->outsourced_item_id)->first();
            $total_outsource_cost += $outsourced_item->total_price;
            $outsourced_item->item_name = $out_item->item_name;
        }
        //extra cost is idk. Maybe per KM distance. Google Calculate Distance API?
        $total_cost = $total_staff_cost + $total_outsource_cost + $total_dish_cost + $total_inv_cost + $extra_cost;
        return view('company_quotation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,'is_off_premise'=>$is_off_premise,
                'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes, 'staffs'=>$employees,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost,
                'total_cost'=>$total_cost,'total_dish_cost'=>$total_dish_cost , 'total_inv_cost'=>$total_inv_cost,
                'outsourced_items'=>$outsourced_items,'extra_cost'=>$extra_cost,'total_outsource_cost'=>$total_outsource_cost]);
    }
}
