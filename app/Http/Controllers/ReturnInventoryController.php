<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
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
        $eventFinished = DB::table('event')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->select('*')
        ->where('event.status', '=', '5')
        ->get();

        $date = Carbon::now('+8:00');
        // dd($date);

        // $check = (Carbon::parse($date)->gt($event[0]->event_start));
       
        $finishedEvents = array();

        foreach($eventFinished as $i){
            if(Carbon::parse($i->event_end)->format('Y-m-d') <= $date->format('Y-m-d')){
                array_push($finishedEvents, $i);
            }
        }

        return view('returnInventory',['events' => $finishedEvents]);
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
        $borrowedItems = DB::table('event')
        ->select('*')
        ->where('event.event_id', '=', $id)
        ->join('event_inventory', 'event.event_id', '=', 'event_inventory.event_id')
        ->join('inventory', 'event_inventory.inventory_id', '=' ,'inventory.inventory_id')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('category_ref', 'inventory.category', '=', 'category_ref.category_no')
        ->join('color','inventory.color','=','color.color_id')
        ->join('client', 'event.client_id', '=', 'client.client_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->get();

        // dd($borrowedItems);

        return view('viewEventReturn', ['borrowedItems' => $borrowedItems ]);
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

        foreach($borrowedItems as $i){
            $item = DB::table('inventory')
            ->where('inventory_id', '=', $i->inventory_id)
            ->update([
                'quantity' => $request->input('quantity'),
            ]);
        }
        dd($borrowedItems);

        $a = array();

        // foreach($request->input('qtyReturnArray') as $i){
        //     $i
        // }
        $a = $request->input('qtyReturned');
        // dd($a);

        $item = DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->update([
            'quantity'      => $request->input('quantity'),
        ]);
        
        
        return redirect('/inventory')->with('success', 'Item Updated');

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
