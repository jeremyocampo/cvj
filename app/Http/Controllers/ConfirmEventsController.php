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
use App\billing;
use App\payment;
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
    public function store(Request $request) { 
        // dd($request->has('decline'));
        $event_idA = $request->input('eventA');
        $event_idD = $request->input('eventD');
        // dd($event_idA, $event_idD);
        if ($request->has('approve')) {
                   
            $billing = new billing();
            $billing->event_billed = $request->input('eventA');
            // $billing->price = $request->input('amount');
            $billing->save();


            $payment = new payment();
            $payment->billing_id = $billing->billing_id;
            $payment->payment_amount = $request->input('amount');
            $payment->date_paid = Carbon::now('+8:00');

            

            if ($request->hasFile('reciept')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('receipt');
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('receipt');
            //File Name to Store    
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
                $path = $request->file('receipt')->storeAs('public/receipt', $fileNameToStore);
                $payment->receipt = $path;
                $payment->save();
            }

            else{
                $fileNameToStore = 'noimage.jpg';
            }

            $event = DB::table('event')
            ->where('event_id', '=', $event_idA)
            ->update([
                'status' => 2,
            ]);

            

            return redirect('confirmevents')->with('success', 'Event Approved!');
        }
        
       if($request->has('decline')) {
            $event = DB::table('event')
            ->where('event_id', '=', $event_idD)
            ->update([
                'status' => 6,
            ]);

            // $event = new events();
            // $event::where('event_id','=', $request->input('event'));
            // $event->status = 6;
            // $event->save();


            
            // dd($request->has('decline'));
            // dd($event_id);
            
            return redirect('confirmevents')->with('success', 'Event Declined!');
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
       
    }
}