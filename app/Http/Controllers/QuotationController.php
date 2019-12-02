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
use PDF;
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

        $this->test_export_quotation_pdf(['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,
            'additional_count'=>$additional_count,'add_dish_total'=>$add_dish_total,'add_inv_total'=>$add_inv_total,
            'additional_dishes'=>$event_dishes, 'is_off_premise'=>$is_off_premise,
            'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost],$event_id);

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
        $avail_methods = array();


        $event = events::where('event_id','=',$event_id)->first();
        $client = Client::where('client_id','=',$event->client_id)->first();

        $is_analogous = $event->get_analogous_event_model();

        error_log("is analogous: ".$event->get_analogous_event_model());
        if($event->status < 2 ){
            if($is_analogous != -1){
                array_push($avail_methods, array("selected"=>true,"value"=>"analogous","name"=>"Analogous Estimation"));
            }
            if($event->costing_method == null){
                array_push($avail_methods, array("selected"=>true,"value"=>null,"name"=>"Fixed Estimation"));
            }
            else{
                array_push($avail_methods, array("selected"=>false,"value"=>null,"name"=>"Fixed Estimation"));
            }
        }

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

            $dish->unit_expense = $is_analogous != -1 ? round($dish->get_analogous_item($event_id)->actual_amount/$package->suggested_pax,2) : $itm->unit_expense;
            $total_dish_cost += $is_analogous != -1 ? $dish->get_analogous_item($event_id)->actual_amount: $itm->unit_expense * $package->suggested_pax;

        }
        error_log("total_dish_cost: ".$total_dish_cost);
        foreach($outsourced_items as $outsourced_item){
            $out_item = OutsourcedItem::where('outsourced_item_id','=',$outsourced_item->outsourced_item_id)->first();
            $total_outsource_cost += $outsourced_item->total_price;
            $outsourced_item->item_name = $out_item->item_name;
            //idk with this.
        }
        //extra cost is idk. Maybe per KM distance. Google Calculate Distance API?
        $total_cost = $total_staff_cost + $total_outsource_cost + $total_dish_cost + $total_inv_cost + $extra_cost;

        return view('company_quotation',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,'client'=>$client,'is_off_premise'=>$is_off_premise,
                'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes, 'staffs'=>$employees,
                'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost,
                'total_cost'=>$total_cost,'total_dish_cost'=>$total_dish_cost , 'total_inv_cost'=>$total_inv_cost,
                'outsourced_items'=>$outsourced_items,'extra_cost'=>$extra_cost,'total_outsource_cost'=>$total_outsource_cost,
                'avail_methods'=>$avail_methods]);
    }

    public function test_export_quotation_pdf($data,$event_id)
    {
        $event = events::where('event_id','=',$event_id)->first();
        // Fetch all customers from database
        //$data = Customer::get();
        // Send data to the view using loadView function of PDF facade

        $pdf = PDF::loadView('samp', $data);
        $fileName = time()."_cliQuot_autogen.pdf";

        error_log("idyota: ".$fileName);
        $event->save_client_quotation('/app/uploads/'.$fileName);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'/app/uploads/'.$fileName);


        //  $request->fileToUpload_deposit->storeAs('uploads',$fileName);
        // Finally, you can download the file using download function
        return redirect('list_events');
    }
    public function export_quotation_pdf($event_id)
    {
        $event = events::where('event_id','=',$event_id)->first();
        // Fetch all customers from database
        //$data = Customer::get();
        // Send data to the view using loadView function of PDF facade
        $data = [
            'title' => 'First PDF for Medium',
            'heading' => 'Hello from 99Points.info',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry'
            ];
        $pdf = PDF::loadView('samp', $data);
        $fileName = time()."_dep.pdf";

        $event->save_client_quotation('/app/uploads/'.$fileName);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'/app/uploads/'.$fileName);


        //  $request->fileToUpload_deposit->storeAs('uploads',$fileName);
        // Finally, you can download the file using download function
        return redirect('list_events');
    }
    public function change_costing_method(Request $request){
        $event = events::where('event_id','=',$request->input("event_id"))->first();
        $event->costing_method = $request->input("costing_method");
        $event->reset_event_dish_cost_amount();

        if($this->get_analogous_event_model() != null){
            $event_dishes = EventDishes::where('event_id','=',$request->input("event_id"))->get();
            foreach($event_dishes as $event_dish){
                $event_dish->cost_amount = $event_dish->get_analogous_item($event->event_id)->actual_amount;
                $event_dish->save();
            }
        }
        else{
            $event->set_default_cost_amount();
        }

        $event->save();
        return redirect('company_quotation/'.$request->input("event_id"));
    }
}
