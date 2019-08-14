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
use Faker\Generator as Faker;
use Spatie\GoogleCalendar\Event;

class ConfirmEventsController extends Controller
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
        //create a new event
        // $event = new Event;

        // $event->name = 'A new event';
        // $event->startDateTime = Carbon\Carbon::now();
        // $event->endDateTime = Carbon\Carbon::now()->addHour();
        // $event->addAttendee(['email' => 'youremail@gmail.com']);
        // $event->addAttendee(['email' => 'anotherEmail@gmail.com']);

        // $event->save();

        // get all future events on a calendar
        // $events = Event::get();

        $eventdetails = DB::table('event')
        // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
        ->select('*')
        ->where('event.status', '=', '1')
        ->get();
        // dd($eventdetails);
        return view('confirmevents', [ 'eventdetails' => $eventdetails]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        dd($request->input('event'));
        if ($request->has('approve')) {
            //handle form1
            $this->validate($request, [
                'amount' => 'required|number|min:20000',
                'receipt'     =>  'required|image|mimes:jpeg,png,jpg|max:2048'
                
            ]);
            $billing = DB::table('billing')
            ->update([
                'event_billed' => $request->input('eventID')
            ])
            $payment = DB::table('payment')
            ->update([
                'billing_id' => $request->input('eventID'),
                'payment_amount' => $request->input('amount'),
                'date_paid' => Carbon::now(),
                'receipt' => $request->input('reciept')

            ]);
            // $billing->save();

            $event = DB::table('event')
            ->update([
                ''

            ]);
        }
        
        else if ($request->has('decline')) {
            //handle form2

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