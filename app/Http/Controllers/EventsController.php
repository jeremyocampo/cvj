<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\events;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\User;
use Faker\Generator as Faker;
use Spatie\GoogleCalendar\Event;

class EventsController extends Controller
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

        $eventPending = DB::table('event')
            // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->where('event.status', '<', '2')
            ->get();

        $eventApproved = DB::table('event')
            // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->where('event.status', '>', '1')
            ->get();

        $date = Carbon::now();
        // dd($date);

        // $check = (Carbon::parse($date)->gt($event[0]->event_start));
        $upcomingPendingEvents = array();
        $upcomingApprovedEvents = array();

        foreach($eventPending as $i){
            if(Carbon::parse($i->event_start)->format('Y-m-d') >= $date->subDay()->format('Y-m-d')){
                array_push($upcomingPendingEvents, $i);
            }
        }

        foreach($eventApproved as $b){
            if(Carbon::parse($b->event_start)->format('Y-m-d') >= $date->subDay()->format('Y-m-d')){
                array_push($upcomingApprovedEvents, $b);
            }
        }
        // dd($eventEndString);

        return view('eventsDash', ['pendingEvents' => $upcomingPendingEvents, 'events' => $upcomingApprovedEvents]);
        // return view('eventsDash');
    }

    public function list_events()
    {
        //create a new event
        // $event = new Event;

        // $event->name = 'A new event';
        // $event->startDateTime = Carbon\Carbon::now();
        // $event->endDateTime = Carbon\Carbon::now()->addHour();
        // $event->addAttendee(['email' => 'youremail@gmail.com']);
        // $event->addAttendee(['email' => 'anotherEmail@gmail.com']);

        // $event->save();

        // get all future events on a calendar


        // update existing event
        // $firstEvent = $events->first();
        // $firstEvent->name = 'updated name';
        // $firstEvent->save();

        // $firstEvent->update(['name' => 'updated again']);

        // // create a new event
        // Event::create([
        // 'name' => 'A new event',
        // 'startDateTime' => Carbon\Carbon::now(),
        // 'endDateTime' => Carbon\Carbon::now()->addHour(),
        // ]);

        // // delete an event
        // $event->delete();
        // dd($events);

        //Gets events from google calendar
        // $events = Event::get();

        //Gets events from Database
        $eventPending = DB::table('event')
            // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->where('event.status', '=', '1')
            ->get();

        $eventApproved = DB::table('event')
            // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->where('event.status', '>', '1')
            ->get();

        $date = Carbon::now();
        // dd($date);

        // $check = (Carbon::parse($date)->gt($event[0]->event_start));
        $upcomingPendingEvents = array();
        $upcomingApprovedEvents = array();
        foreach($eventPending as $i){
            $e = events::where('event_id','=',$i->event_id)->first();
            $pack = $e->package();
            error_log("package: ".$pack);
            $i->need_outsource = $e->is_need_outsource();
            if($pack){
                $i->package_name = $pack->package_name;
            }else{
                $i->package_name = 'n/a';
            }
            $i->quotations = $e->get_quotations();
            if(Carbon::parse($i->event_start)->format('Y-m-d') >= $date->subDay()->format('Y-m-d')){
                array_push($upcomingPendingEvents, $i);
            }
        }
        /*
        $event_invs = DB::select('select inventory_id, sum(qty) as qty from event_inventory where event_id = ? group by inventory_id',[31]);

        foreach($event_invs as $inv){
            error_log("Amporkchop: ".$inv->inventory_id." ".$inv->qty);
        }
        */

        foreach($eventApproved as $b){

            $e = events::where('event_id','=',$b->event_id)->first();
            $pack = $e->package();
            if($pack){
                $b->package_name = $pack->package_name;
            }else{
                $b->package_name = 'n/a';
            }

            $b->quotations = $e->get_quotations();
            if(Carbon::parse($b->event_start)->format('Y-m-d') >= $date->subDay()->format('Y-m-d')){
                array_push($upcomingApprovedEvents, $b);
            }
        }
        // dd($eventEndString);

        $user = User::where('id','=', auth()->user()->id)->first();


        return view('listevents', ['user'=>$user,'pendingEvents' => $upcomingPendingEvents, 'events' => $upcomingApprovedEvents]);
        // return view('eventsDash');
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
        // create a new event
        // Event::create([
        // 'name' => 'A new event',
        // 'startDateTime' => Carbon\Carbon::now(),
        // 'endDateTime' => Carbon\Carbon::now()->addHour(),
        // ]);
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
            ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->where('event.status', '<', '2')
            ->get();

        return view('viewEventDeets');
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
        // update existing event
        // $firstEvent = $events->first();
        // $firstEvent->name = 'updated name';
        // $firstEvent->save();

        // $firstEvent->update(['name' => 'updated again']);
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
        // // delete an event
        // $event->delete();
        // dd($events);
    }
}
