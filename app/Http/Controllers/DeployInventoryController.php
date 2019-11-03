<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\event;
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
        $eventInProgress = DB::table('event')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->select('*')
        ->where('event.status', '=', '3')
        ->get();

        $date = Carbon::now('+8:00');
        // dd($date);

        // $check = (Carbon::parse($date)->gt($event[0]->event_start));
        
       
        $inprogress = array();

        foreach($eventInProgress as $i){
            // $twoDaysBefore = Carbon::parse($i->event_end)->format('Y-m-d')->subDay(2);

            if($date->format('Y-m-d') == Carbon::parse($i->event_start)->format('Y-m-d')){
                array_push($inprogress, $i);
            }
        }

        // $joinedTable = DB::table('event')
        // ->get();
        // $eventPackages = DB::table('event');

        return view('deployInventory', ['events'  => $inprogress ]);
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
        // ->join('package_item', 'package.package_id', '=', 'package_item.package_id')
        ->select('*')
        // ->where('')
        ->get();

        $packagesA = DB::table('package')
        ->join('package_inventory', 'package.package_id', '=', 'package_inventory.package_id')
        // ->join('inventory', 'package_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->join('package_item', 'package.package_id', '=', 'package_item.package_id')
        ->join('items', 'package_item.item_id', '=', 'items.item_id')
        ->select('*')
        // ->where('')
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
            foreach($packagesA as $c){
                if ($c->package_id == $package){
                    array_push($eventItems, $c);
                }
            }
        }


        // dd($event, $packages);

        // dd($event, $eventPackages, $eventItems);

        // return view('viewEventDeploy',[ 'event' => $event, 'package' => $eventPackages, 'packageA' => $eventItems]);
        return view('viewEventDeploy');

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

        return redirect('/deploy')->with('success', 'Inventory has been deployed!');

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
