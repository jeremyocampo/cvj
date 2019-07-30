<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Spatie\GoogleCalendar\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a new event
        $event = new Event;

        // $event->name = 'A new event';
        // $event->startDateTime = Carbon\Carbon::now();
        // $event->endDateTime = Carbon\Carbon::now()->addHour();
        // $event->addAttendee(['email' => 'youremail@gmail.com']);
        // $event->addAttendee(['email' => 'anotherEmail@gmail.com']);

        // $event->save();

        // get all future events on a calendar
        $events = Event::get();

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

        return view('eventsDash', ['events' => $events]);
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