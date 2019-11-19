<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\event;
use App\deployed_inventory;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Faker\Generator as Faker;
use App\PackageInventory;

class DeployInventoryController extends Controller
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
        $query = DB::table('deployed_inventory')->get();

        $eventInProgress = DB::table('event')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->select('*')
        ->where('event.status', '=', 3)
        ->where('event.status', '<', 6)
        ->get();

        // dd($eventInProgress);

        $eventsDep = DB::table('event')
        ->join('deployed_inventory', 'event.event_id', '=', 'deployed_inventory.event_deployed')
        ->get();

        $date = Carbon::now('+8:00');

    //    dd($date);
        $inprogress = array();
        $deployed = array();

        foreach($eventsDep as $h){
            array_push($deployed, $h);
        }

        foreach($eventInProgress as $i){
            // $twoDaysBefore = Carbon::parse($i->event_end)->format('Y-m-d')->subDay(2);

            if($date->format('Y-m-d') == Carbon::parse($i->event_start)->format('Y-m-d')){
                array_push($inprogress, $i);
            }
        }

        // $joinedTable = DB::table('event')
        // ->get();
        // $eventPackages = DB::table('event');
        // dd($eventsDep);

        return view('deployInventory', ['events'  => $inprogress, 'eventsDep' => $eventsDep ]);
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

        $this->validate($request, [
            'employeeAssigned'      => 'required|numeric|min:1',
        ],[
            'employeeAssigned.required'      => 'Please Assign an Employee for Deployment.',
            'employeeAssigned.numeric'      => 'Please Assign an Employee for Deployment.',
            'employeeAssigned.min'      => 'Please Assign an Employee for Deployment.',
        ]);

        $eventID = $request->input('event_id');

        $packages = DB::table('event')
        ->join('package', 'event.package_id','=','package.package_id')
        ->join('package_inventory', 'package.package_id', '=', 'package_inventory.package_id')
        ->join('inventory', 'package_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->select('*')
        ->where('event.event_id', '=', $eventID)
        ->get();

        // dd($packages);

        // $deploy_inventory = new deployed_inventory();

        $inventory = DB::table('inventory')
        ->get();
        
        // $differences = array();
        foreach($packages as $i){
            $deploy_inventory = new deployed_inventory();
            $deploy_inventory->event_deployed = $i->event_id;
            $deploy_inventory->inventory_deployed = $i->inventory_id;
            $deploy_inventory->quantity = $i->qty;
            $deploy_inventory->employee_assigned = $request->input('employeeAssigned');
            $deploy_inventory->barcode = $i->sku;
            $deploy_inventory->save();

            $newQuantity = DB::table('inventory')
            ->select('*')
            ->where('inventory_id','=',$i->inventory_id)
            ->get();

            $difference = $newQuantity[0]->quantity - $i->qty;
            
            // array_push($differences, $difference);
            // dd($difference);

            $item = DB::table('inventory')
            ->where('inventory_id', '=', $i->inventory_id)
            ->update([
                'quantity'      => $difference,
            ]);
            
        }

        // dd($differences);

        
        
        // dd($inventory);

        return redirect('/deploy')->with('success', 'Event Items Deployed!');


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
        // dd((int)$id);
        $event = DB::table('event')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        // ->join('package_inventory', 'package.package_id','=', 'package_inventory.package_id')
        // ->join('inventory', 'package_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->select('*')
        ->where('event.event_id', '=', (int)$id)
        ->get();

        $packages = DB::table('package')
        ->join('package_inventory', 'package.package_id', '=', 'package_inventory.package_id')
        ->join('inventory', 'package_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->join('category_ref','inventory.category','=','category_ref.category_no')
        ->join('color','inventory.color','=','color.color_id')
        // ->join('package_item', 'package.package_id', '=', 'package_item.package_id')
        ->select('*')
        // ->orderBy('inventory_id','DESC')
        // ->where('')
        ->get();

        // dd($packages);

        $employees = DB::table('employee')
        ->select('*')
        ->where('employee.employee_type', '=', 'Logistics')
        // ->where('employee.assigned_events', '<=', '5')
        ->get();

        $eventPackages = array();
        $eventItems = array();
        
        foreach($event as $i){
            $package = $i->package_id;

            foreach($packages as $b){
                if ($b->package_id == $package){
                    array_push($eventPackages, $b);
                }
            }
            // foreach($packagesA as $c){
            //     if ($c->package_id == $package){
            //         array_push($eventItems, $c);
            //     }
            // }
        }

        // dd($employees);
        // dd($eventPackages);
        // dd($event, $packages);

        // dd($event, $eventPackages, $eventItems);

        return view('viewEventDeploy',[ 'event' => $event, 'package' => $eventPackages, 'employees' => $employees]);
        // return view('viewEventDeploy');

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
        // $event = DB::table('event')
    
        // ->join('package', 'event.package_id', '=', 'package.package_id')
        
        // ->select('*')
        // ->where('event.event_id', '=', (int)$id)
       
        // ->update([
        //     'status' => 4,
        // ]);

      
        // $event = DB::table('event')
        // ->where('event.event_id', '=', (int)$id)
        // ->get();

      
        // foreach (DB::table('package_inventory')->where('package_id','=',$event->package_id)->get() as $inv){
        //     $e_inv = new EventInventory();
        //     $inv_inv = inventory::where('inventory_id','=',$inv->inventory_id);
        //     $e_inv->event_id = $event->event_id;
        //     $e_inv->inventory_id = $inv->inventory_id;
        //     $e_inv->qty = $inv->quantity;
        //     $e_inv->rent_price = $inv->rent_cost;
        //     $e_inv->esku = $inv_inv->sku;
        //     $e_inv->status = "Borrowed";
        //     $e_inv->save();
        // }

        return redirect('/deploy')->with('success', 'Event Inventory has been deployed!');

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
