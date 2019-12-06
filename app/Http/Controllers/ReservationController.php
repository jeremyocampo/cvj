<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\AddRequest;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.index');
    }

    public function store(AddRequest $request)
    {
        $reservation = Reservation::where('event_date', $request->event_date)
            ->where('event_place', $request->event_place)
            ->where('time', $request->time)
            ->first();

        if ($reservation === null) {
            $reservation = new Reservation($request->validated());
            $reservation->save();
    
            return response()->json($reservation);
        }

        return response()->json([
            'message' => 'Events is now reserved'
        ], 422);
    }

    public function getEvent(Request $request)
    {
        $month = new Carbon($request->date);

        $events = Reservation::whereRAW('MONTH(event_date) = ' . $month->format('m'))->get();

        return response()->json($events);
    }
}
