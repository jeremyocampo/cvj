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

class MarkLostDamagedController extends Controller
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
        //
        $event = DB::table('event')
        ->join('damaged_inventory','event.event_id','=','damaged_inventory.event_deployed')
        ->select('event.event_id')
        ->groupBy('event.event_id')
        ->get();

        $actuallyDamaged = array();

        foreach($event as $a)
        {
            $eventsActuallyDamaged = DB::table('event')
            ->select('*')
            ->where('event.event_id', '=', $a->event_id)
            ->join('event_status_ref','event.status', '=', 'event_status_ref.status_id')
            ->first();

            array_push($actuallyDamaged, $eventsActuallyDamaged);
        }

        $date = Carbon::now('+8:00');

        $assigned = DB::table('damaged_inventory')
        ->join('manpowers','damaged_inventory.employee_assigned','=','manpowers.id')
        ->select('*')
        ->first();

        return view('markLostDamaged',['events' => $actuallyDamaged, 'dateToday' => $date, 'employee' => $assigned]);
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
        $this->validate($request, [
            'reason'      => 'required',
            // 'idReturnArray'      => 'required',
        ],[
            'reason.required'     => 'Please do not leave the Reason Field Empty',
            // 'category.required'     => 'Please Select a Category.',
        ]);

        // dd($request);

        // $updateReasons = DB::table('damaged_inventory')
        // ->where('event_deployed', '=', $request->input('event_id')
        // ->update([
        //     'reason'      => ,
        // ]);

        return view('markLostDamage')->with('success', 'Event Items reported as Lost/Damaged');


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
        ->select('*')
        ->where('event.event_id', '=', $id)
        ->join('event_status_ref','event.status', '=', 'event_status_ref.status_id')
        ->join('package', 'event.package_id','=','package.package_id')
        ->first();

        $lostDamaged = DB::table('damaged_inventory')
        ->join('inventory', 'damaged_inventory.inventory_deployed','=','inventory.inventory_id')
        ->join('category_ref','inventory.category','=','category_ref.category_no')
        ->join('color','inventory.color','=','color.color_id')
        ->select('*')
        ->where('event_deployed','=', $id)
        ->get();

        // dd($lostDamaged);
        $assigned = DB::table('deployed_inventory')
        ->join('manpowers','deployed_inventory.employee_assigned','=','manpowers.id')
        ->select('*')
        ->where('event_deployed', '=', $id)
        ->first();

        return view('viewMarkLostDamaged', ['event' => $event, 'lostDamaged' => $lostDamaged, 'employee' => $assigned]);
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
