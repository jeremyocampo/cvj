<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\inventory;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\damaged_inventory;

class ReturnInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        ///DEPLOY
        $eventsDep = DB::table('event')
        ->join('deployed_inventory','event.event_id','=','deployed_inventory.event_deployed')
        ->select('event.event_id')
        ->groupBy('event.event_id')
        ->get();

        $actuallyDeployed = array();

        foreach($eventsDep as $a)
        {
            $eventsActuallyDeployed = DB::table('event')
            ->select('*')
            ->where('event.event_id', '=', $a->event_id)
            ->join('event_status_ref','event.status', '=', 'event_status_ref.status_id')
            ->first();

            array_push($actuallyDeployed, $eventsActuallyDeployed);
        }

        $date = Carbon::now('+8:00');

        return view('returnInventory',['events' => $actuallyDeployed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $eventID = $request->input('event_id');

        $itemReturns = array();
        $qtyReturns = array();

        $this->validate($request, [
            'qtyReturnArray'      => 'required',
            // 'idReturnArray'      => 'required',
        ],[
            'qtyReturnArray.required'     => 'Please Scan/Input a valid Barcode.',
            // 'category.required'     => 'Please Select a Category.',
        ]);

        $qtyReturns = explode(',', $request->input('qtyReturnArray'));
        $itemReturns = explode(',', $request->input('idReturnArray'));

        $returns = array();

        for($i=0; $i< count($qtyReturns); $i++){
            Arr::set($returns, ''.$itemReturns[$i], $itemReturns[$i].','.$qtyReturns[$i]);
        }

        // dd($returns);

        $event = DB::table('event')
        ->select('*')
        ->where('event.event_id', '=', $eventID)
        ->first();

        $packages = DB::table('event')
        ->join('package', 'event.package_id','=','package.package_id')
        ->join('package_inventory', 'package.package_id', '=', 'package_inventory.package_id')
        ->join('inventory', 'package_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->select('*')
        ->where('event.event_id', '=', $eventID)
        ->get();

        // dd($packages);

        $inventory = DB::table('inventory')
        ->get();

        $actuallyLost = array();
        
        foreach($packages as $i){
            foreach($returns as $j){
                $returnedItem = explode(',', $j);
                if($i->inventory_id == $returnedItem[0]){
                    if($i->qty == $returnedItem[1]){
                        $sum = $returnedItem[1] + $i->quantity;

                        // dd($sum);
    
                        $item = DB::table('inventory')
                        ->where('inventory_id', '=', $i->inventory_id)
                        ->where('returnable_item','=','Yes')
                        ->update([
                            'quantity'      => $sum,
                        ]);

                        $updateDeployed = DB::table('deployed_inventory')
                        // ->join('inventory','deployed_inventory.inventory_deployed','=','inventory.inventory_id')
                        // ->where('returnable_item','=','Yes')
                        ->where('event_deployed','=', $eventID)
                        ->where('inventory_deployed','=', $returnedItem[0])
                        ->update([
                            'date_returned' => Carbon::now(),
                        ]);
                    }
                    else{
                        $sum = $returnedItem[1] + $i->quantity;
                        $difference = $i->qty - $returnedItem[1];

                        Arr::set($actuallyLost, ''.$returnedItem[0], $returnedItem[0].','.$returnedItem[1]);

                        $barcode = DB::table('deployed_inventory')
                        ->where('inventory_deployed','=', $i->inventory_id)
                        ->where('event_deployed', '=', $eventID)
                        ->select('barcode')
                        ->first();

                        $employeeAssigned = DB::table('deployed_inventory')
                        ->where('inventory_deployed','=', $i->inventory_id)
                        ->where('event_deployed', '=', $eventID)
                        ->select('employee_assigned')
                        ->groupBy('employee_assigned')
                        ->first();

                        // dd($returnedItem[1]);
    
                        $item = DB::table('inventory')
                        ->where('inventory_id', '=', $i->inventory_id)
                        ->update([
                            'quantity'      => $sum,
                        ]);

                        $updateDeployed = DB::table('deployed_inventory')
                        ->where('event_deployed','=', $eventID)
                        ->where('inventory_deployed','=', $returnedItem[0])
                        ->update([
                            'date_returned' => Carbon::now(),
                        ]);

                        // dd();

                        $damaged_inventory = new damaged_inventory();
                        $damaged_inventory->event_deployed = $i->event_id;
                        $damaged_inventory->inventory_deployed = $i->inventory_id;
                        $damaged_inventory->qty = $difference;
                        $damaged_inventory->employee_assigned = $employeeAssigned->employee_assigned;
                        $damaged_inventory->barcode = $barcode->barcode;
                        $damaged_inventory->save();

                        $lost_inventory = new lost_inventory();
                        $lost_inventory->event_deployed = $i->event_id;
                        $lost_inventory->inventory_deployed = $i->inventory_id;
                        $lost_inventory->qty = $difference;
                        $lost_inventory->employee_assigned = $employeeAssigned->employee_assigned;
                        $lost_inventory->barcode = $barcode->barcode;
                        $lost_inventory->save();
                    }
                }
            }
        }

        $event = DB::table('event')
        ->where('event_id','=', $eventID)
        ->update([
            'status' => 5,
        ]);

        $eventIDhasDamage = DB::table('damaged_inventory')
        ->join('event','damaged_inventory.event_deployed','=','event.event_id')
        ->select('event_deployed')
        ->groupBy('event_deployed')
        ->where('event_deployed','=', $eventID)
        ->first();

        // $eventIDisLost = DB::table('lost_inventory')
        // ->join('event','damaged_inventory.event_deployed','=','event.event_id')
        // ->select('event_deployed')
        // ->groupBy('event_deployed')
        // ->where('event_deployed','=', $eventID)
        // ->first();

        // if((!$eventIDhasDamage == null) && (!$eventIDisLost == null)){
        if(!$eventIDhasDamage == null){
            $event = DB::table('event')
            ->select('*')
            ->where('event_id','=',$eventID)
            ->get();

            $deployedItems = DB::table('deployed_inventory')
            ->select('*')
            ->where('event_deployed', '=', $eventID)
            ->join('inventory','deployed_inventory.inventory_deployed','=','inventory.inventory_id')
            ->join('color','inventory.color','=','color.color_id')
            ->get();
     
            $date = DB::table('deployed_inventory')
            ->select('date_deployed')
            ->groupBy('date_deployed')
            ->where('event_deployed', '=', $eventID)
            ->first();
     
            $assigned = DB::table('deployed_inventory')
             ->join('employee','deployed_inventory.employee_assigned','=','employee.employee_id')
             ->select('*')
             ->first();


            return redirect('/markLostDamaged'.'/'.$eventID.'')->with([ 'event' => $event, 'deployed' => $deployedItems, 'dateDeployed' => $date,'employee' => $assigned]);
        } else {
            return redirect('/returnInventory')->with('success', 'Event Items Successfully Returned');
        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $event = DB::table('event')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        ->join('client','event.client_id','=','client.client_id')
        ->select('*')
        ->where('event.event_id', '=', (int)$id)
        ->get();

        $eventId = DB::table('event')
        ->select('event_id')
        ->where('event_id', '=', $id)
        ->first();

       $deployedItems = DB::table('deployed_inventory')
       ->select('*')
       ->where('event_deployed', '=', $eventId->event_id)
       ->join('inventory','deployed_inventory.inventory_deployed','=','inventory.inventory_id')
       ->join('color','inventory.color','=','color.color_id')
       ->get();

       $date = DB::table('deployed_inventory')
       ->select('date_deployed')
       ->groupBy('date_deployed')
       ->where('event_deployed', '=', $eventId->event_id)
       ->first();

       $assigned = DB::table('deployed_inventory')
        ->join('employee','deployed_inventory.employee_assigned','=','employee.employee_id')
        ->select('*')
        ->first();

        return view('viewEventReturn',[ 'event' => $event, 'deployed' => $deployedItems, 'dateDeployed' => $date,'employee' => $assigned]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
