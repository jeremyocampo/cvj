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
<<<<<<< HEAD
        foreach($events as $event) {
            $budget_check = EventBudget::where('event_id', '=', $event->event_id)->first();
            $client = Client::where('client_id', '=', $event->client_id)->first();

            $event->client_name = $client->client_name;
            $event->total_budget = $budget_check == null ? 0 : $budget_check->total_budget;
            $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
            $event->formatted_start = date("H:i", strtotime($event->event_start));
            $event->formatted_end = date("H:i", strtotime($event->event_start));
            //$event->budget = $budget_check == null? null : $budget_check;
            if ($budget_check == null) {
                $budget_check = $this->createAutomatedBudget($event->event_id);
            }
            //$this->send_email($event->client_name,'leebet16@gmail.com',$event->event_name,'Caterie Confirmation');
            $event->total_spent = $budget_check->spent_buffer;
            $event->budget_id = $budget_check->id;
            $employees = EmployeeEventSchedule::select('employee_id')->where('event_id', '=', $event->event_id)->get();
            $event->personnels = Employee::whereIn('employee_id', $employees)->get();
            foreach (EventBudgetItem::where('event_budget_id', '=', $budget_check->id)->get() as $budget_item) {
                $event->total_spent += $budget_item->actual_amount;

                $employees = EmployeeEventSchedule::select('employee_id')->where('event_id', '=', $event->event_id)->get();

                if ($employees != null) {

                    $event->personnels = Employee::whereIn('employee_id', $employees)->get();
                    foreach (EventBudgetItem::where('event_budget_id', '=', $budget_check->id)->get() as $budget_item) {
                        $event->total_spent += $budget_item->actual_amount;
                    }
                }


=======
        foreach($events as $event){
            $budget_check = EventBudget::where('event_name', '=',$event->event_name)->first();
            $client = Client::where('client_id','=',$event->client_id)->first();
            $event->client_name = $client->client_FN ." ".$client->client_LN;
            if($budget_check != null){
                $event->budget_id=$budget_check->id;
            }else{
                $event->budget_id=null;
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
            }
        }
        return view('eventBudget',['events'=>$events]);
    }
<<<<<<< HEAD

    public function get_available_personnel($event_id){
        $event = Event::where('event_id','=',$event_id)->first();
        $employees=EmployeeEventSchedule::select('employee_id')->where('event_id','=',$event->event_id)->get();
        $event->personnel=Employee::whereIn('employee_id',$employees)->get();
        $event_personel = array();
        foreach($event->personnel as $personnel){array_push($event_personel,$personnel->employee_id);}

        $personnels = Employee::whereNotIn("employee_id",$event_personel)->get();
        $avail_personnel = array();
=======
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $event_budget = new EventBudget();
        $event_budget->event_name = $request->input('event');
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
        return redirect('event_budgets');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $check_budget = EventBudget::where('event_name','=',$event_id)->first();
        $budget_templates = EventBudgetTemplate::all();
        foreach($budget_templates as $budget_template){
            $budget_template->items = EventBudgetTemplateItem::where('event_budget_template_id','=',$budget_template->id)->get();
        }
        if($check_budget != null){
            $check_budget->budget_items = EventBudgetItem::where('event_budget_id','=',$check_budget->id)->get();
        }
        $event = Event::where('event_name','=',$event_id)->first();
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

}
