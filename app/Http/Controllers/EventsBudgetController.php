<?php

namespace App\Http\Controllers;

use App\EventBudget;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\inventory;
use App\categoryRef;
use App\OutsourcedItem;
use App\EventBudgetTemplate;
use App\EventBudgetTemplateItem;
use App\EventBudgetItem;
use App\Package;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\Client;

class EventsBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::All();
        foreach($events as $event){
            $budget_check = EventBudget::where('event_id', '=',$event->event_id)->first();
            $client = Client::where('client_id','=',$event->client_id)->first();
            $event->client_name = $client->client_FN ." ".$client->client_LN;
            $event->total_budget = $budget_check == null? 0 : $budget_check->total_budget;
            //$event->budget = $budget_check == null? null : $budget_check;
            if($budget_check != null){
                $event->total_spent = 0;
                $event->budget_id=$budget_check->id;
                foreach(EventBudgetItem::where('event_budget_id','=',$budget_check->id)->get() as $budget_item){
                    $event->total_spent += $budget_item->actual_amount;
                }
            }else{
                $event->budget_id=null;
            }
        }
        return view('eventBudget',['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->input('action') == "add"){
            $event_budget = new EventBudget();
            $event_budget->event_id = $request->input('event');
            $event_budget->total_buffer = $request->input('total_buffer_amount');
            $event_budget->total_budget = 0;
            $event_budget->save();
            for($i=0; $i<count($request->input("names"));$i++){
                $event_budget_item = new EventBudgetItem();
                $event_budget_item->event_budget_id = $event_budget->id;
                $event_budget_item->item_name = $request->get("names")[$i];
                $event_budget_item->budget_amount = $request->get("vals")[$i];
                $event_budget_item->save();
                $event_budget->total_budget +=$event_budget_item->budget_amount;
            }
            $event_budget->save();
        }
        else{
            $event_budget = EventBudget::where('id','=',$request->get("budget_id"))->first();
            $event_budget->total_budget = 0;
            $event_budget->total_buffer = $request->input('total_buffer_amount');
            $event_budget->spent_buffer = $request->input('spent_buffer_amount');
            $to_delete = explode(",",$request->input('to_delete'));
            array_shift($to_delete);
            //delete first
            foreach ($to_delete as $delete){
                EventBudgetItem::where('id','=',$delete)->first()->delete();
            }
            $update_budget_items = EventBudgetItem::where('event_budget_id','=',$request->get("budget_id"))->get();
            for($i=0; $i<count($request->input("old_acts"));$i++){
                $update_budget_items[$i]->item_name = $request->input("old_names")[$i];
                $update_budget_items[$i]->budget_amount = $request->input("old_vals")[$i];
                $update_budget_items[$i]->actual_amount = $request->input("old_acts")[$i];
                $update_budget_items[$i]->save();
                $event_budget->total_budget += $update_budget_items[$i]->budget_amount;
            }
            for($i=0; $i<count($request->input("acts"));$i++){
                $event_budget_item = new EventBudgetItem();
                $event_budget_item->event_budget_id = $event_budget->id;
                $event_budget_item->item_name = $request->get("names")[$i];
                $update_budget_items[$i]->actual_amount = $request->input("acts")[$i];
                $event_budget_item->budget_amount = $request->get("vals")[$i];
                $event_budget_item->save();
                $event_budget->total_budget +=$event_budget_item->budget_amount;
            }
            $event_budget->save();
        }

        return redirect('event_budgets');
    }


    public function show($event_id)
    {
        $event = Event::where('event_id','=',$event_id)->first();
        $check_budget = EventBudget::where('event_id','=',$event->event_id)->first();
        $budget_templates = EventBudgetTemplate::all();
        foreach($budget_templates as $budget_template){
            $budget_template->items = EventBudgetTemplateItem::where('event_budget_template_id','=',$budget_template->id)->get();

        }
        if($check_budget != null){
            $check_budget->budget_items = EventBudgetItem::where('event_budget_id','=',$check_budget->id)->get();
            foreach($check_budget->budget_items as $budget_item){
                $budget_item->overflow = false;
                if($budget_item->actual_amount > $budget_item->budget_amount){
                    $budget_item->overflow = true;
                }
            }
        }
        return view('viewEventBudget',['event'=>$event,'event_id'=>$event_id,'budget'=>$check_budget,'budget_templates'=>$budget_templates]);
    }

    public function createIndex($event_id)
    {   }

    public static function getSupplier_by_Id($id){
       return $supplier = Supplier::where('supplier_id', '=',$id)->first();
    }

    public static function getPackage_by_Id($id){
        return $supplier = Package::where('package_id', '=',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
