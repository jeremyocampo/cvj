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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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

        // dd($actuallyDeployed);

        
        $date = Carbon::now('+8:00');

        $inprogress = array();

        $eventInProgress = DB::table('event')
        // ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->select('*')
        ->where('event.status', '=', 2)
        ->where('event.status', '<', 6)
        // ->where('event_start', '<=', $date)
        ->orderBy('event_start', 'ASC')
        ->get();

        // dd($eventInProgress);
        

        // if(count($eventsDep) != 0)
        if(count($actuallyDeployed) != 0)
        {
            foreach($eventInProgress as $k)
            {
                // foreach($eventsDep as $g)
                foreach($actuallyDeployed as $g)
                {
                    if($k->event_id != $g->event_id )
                    {
                        if($date->format('Y-m-d') == Carbon::parse($k->event_start)->format('Y-m-d'))
                        {
                            if(count($inprogress) != 0)
                            {
                                foreach($inprogress as $undeployed)
                                {
                                    if($undeployed->event_id != $k->event_id)
                                    {
                                        array_push($inprogress, $k);
                                    } 
                                }
                            } 
                            else 
                            {
                                array_push($inprogress, $k);
                            }
                            
                        }
                    }
                }
            }
        }
        else
        {
            foreach($eventInProgress as $k)
            {
                if($date->format('Y-m-d') == Carbon::parse($k->event_start)->format('Y-m-d'))
                {
                    array_push($inprogress, $k);
                }
            }
        }

        // dd($inprogress);

        return view('deployInventory', ['events'  => $inprogress, 'eventsDep' => $actuallyDeployed ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Faker $faker)
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

        // $event = DB::table('event')
        // ->where('event_id', '=', $eventID)
        // ->update([
        //     'status'      => 4,
        // ]);

        $eventItems = DB::table('event')
        // ->join('package', 'event.package_id','=','package.package_id')
        ->join('event_inventory', 'event.event_id', '=', 'event_inventory.event_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        ->join('inventory', 'event_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->select('*')
        ->where('event.event_id', '=', $eventID)
        ->get();

        // dd($eventItems);

        $inventory = DB::table('inventory')
        ->get();
        
        foreach($eventItems as $i){
            $deploy_inventory = new deployed_inventory();
            $deploy_inventory->event_deployed = $i->event_id;
            $deploy_inventory->inventory_deployed = $i->inventory_id;
            $deploy_inventory->qty = $i->qty;
            $deploy_inventory->employee_assigned = $request->input('employeeAssigned');
            $deploy_inventory->barcode = $faker->unique()->isbn13;
            $deploy_inventory->save();

            $newQuantity = DB::table('inventory')
            ->select('*')
            ->where('inventory_id','=',$i->inventory_id)
            ->get();

            $differenceQty = $newQuantity[0]->quantity - $i->qty;
            $differenceLife = $newQuantity[0]->shelf_life - 1;
            
            $item = DB::table('inventory')
            ->where('inventory_id', '=', $i->inventory_id)
            ->update([
                'quantity'      => $differenceQty,
                'shelf_life'    => $differenceLife,
            ]);

            $eventUpdate = DB::table('event')
            ->where('event.event_id', '=', $request->input('event_id'))
            ->update([
                'status'    => 3,
            ]);
            
        }

        return redirect('/deploy')->with('success', 'Event Items Deployed!');
    }

    public function show($id)
    {
        //
        $event = DB::table('event')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        ->select('*')
        ->where('event.event_id', '=', (int)$id)
        ->get();

        // dd($event);
        // $packages = DB::table('package')
        // ->join('event', 'package.package_id', '=', 'event.package_id')
        // ->join('inventory', 'event_inventory.inventory_id', '=', 'inventory.inventory_id')
        // ->join('category_ref','inventory.category','=','category_ref.category_no')
        // ->join('color','inventory.color','=','color.color_id')
        // ->select('*')
        // ->get();

        $eventItems = DB::table('event_inventory')
        ->join('event', 'event_inventory.event_id', '=', 'event.event_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        ->join('inventory', 'event_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->join('category_ref','inventory.category','=','category_ref.category_no')
        ->join('color','inventory.color','=','color.color_id')
        ->select('*')
        // ->where('event_id', '=', $event->event_id)
        ->get();

        // dd($eventItems);

        $employees = DB::table('manpowers')
        ->select('*')
        ->where('manpowers.employee_type', '=', 'Logistics')
        ->get();

       $itemsToBeDeployed = array();

    

       foreach($eventItems as $item)
       {
        //    dd($item->event_id);
           if ($item->event_id == $id){
               array_push($itemsToBeDeployed, $item);
           }
       }
        //   dd($itemsToBeDeployed);
        // return view('viewEventDeploy',[ 'event' => $event, 'package' => $eventPackages, 'employees' => $employees]);
        return view('viewEventDeploy',[ 'event' => $event, 'package' => $itemsToBeDeployed, 'employees' => $employees]);
    }

    public function edit($id)
    {
        //

    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
