<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\inventory;
use Faker\Generator as Faker;

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

    //    dd($date);

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
        $borrowedItems = DB::table('event')
        ->select('*')
        ->where('event.event_id', '=', $id)
        ->join('event_inventory', 'event.event_id', '=', 'event_inventory.event_id')
        ->join('inventory', 'event_inventory.inventory_id', '=' ,'inventory.inventory_id')
        ->get();

        // foreach($borrowedItems as $i){
        //     $item = DB::table('inventory')
        //     ->where('inventory_id', '=', $i->inventory_id)
        //     ->update([
        //         'quantity' => $request->input('quantity'),
        //     ]);
        // }
        // dd($borrowedItems);

        $a = array();
        $b = array();
        $i = 0;

        // foreach($request->input('qtyReturnArray') as $i){
        //     $i
        // }
        $a = $request->input('idReturnArray');
        $b = $request->input('qtyReturnArray');

        $c = explode (",", $a); 
        $d = explode (",", $b); 
        

        $id = $c;
        $number = $d;

        // dd($id, $number);

        for($i = 0; $i < count($c) ; $i++)
        {
            // $item = inventory::find( $c[$i] );
            // $item->increment('quantity',$d[$i]);
            $number = (int)$d[$i];
            $id = (int)$c[$i];

            // dd($id);

            // dd($number);
            // dd($number,$id);
            // $item = DB::update('update cvjdb.inventory set quantity = (quantity + '. $number .') where inventory_id = ' . $id . ';');
           
            // $quantity = DB::table('inventory')
            // ->select('quantity')
            // ->where('inventory.inventory_id', '=', $id)
            // ->get();

            // $item = inventory::find($id);

            // dd($item->quantity);

            if($number != null){
                // $item = DB::table('inventory')
                // ->where('inventory_id', '=', $id)
                // ->update([
                //     'quantity' => $quantity[0]->quantity+$number,
                // ]);
                $item = inventory::find($id);
                $item->quantity = ($item->quantity + $number);
                $item->save();
            } 

        }

        // dd($number[1]);

        
        
        
        return redirect('/returnInventory')->with('success', 'Item(s) Returned');

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
