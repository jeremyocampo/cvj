<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkLostDamagedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        return view('markLostDamage',['']);
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
