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
        ->where('event.status', '=', '4')
        ->get();

        $date = Carbon::now('+8:00');
        // dd($date);

        // $check = (Carbon::parse($date)->gt($event[0]->event_start));
       
        $inprogress = array();

        foreach($eventInProgress as $i){
            if(Carbon::parse($i->event_end)->format('Y-m-d') <= $date->format('Y-m-d')){
                array_push($inprogress, $i);
            }
        }

        $joinedTable = DB::table('event')
        ->get();
        $eventPackages = DB::table('event');
        return view('deployInventory', ['events'  => $joinedTable]);
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
