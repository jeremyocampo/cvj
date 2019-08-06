<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//DB Callings
use Illuminate\Support\Facades\DB;
use App\EventModel;
use App\Http\Requests;
use Session;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class BookEventController extends Controller
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
    public function index(){
       
        $client = DB::table('event')
            // ->join('client_ref','event.client_name','=','client_ref.client_name')
            // ->join('event','client_ref.client_name','=','event.client_name')
            ->get();
        //dd($joinedTable);
        
        $packages = DB::table('package')
            // ->join('package','event.package_id','=','package.package_id')
            // ->join('event','package.package_id','=','event.package_id')
            ->get();

        return view('bookevent', ['clients' => $client, 'packages' => $packages]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bookevent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    //dd($request['eventType']);
    // $loginDet = [
    //     "client_id" => "princessdelapaz",
    //     "password" => "123456"
    // ];

    // Session::put('loginDetails', $loginDet);
    // $loginDetails = Session::get('loginDetails');
    // $client_id = 1;
    $today = Carbon::now('+8:00');

    $eventDate =  Carbon::parse($request->input('eventStartDate'));
    $eventEnd = Carbon::parse($request->input('eventEndDate'))->format('Y-m-d');

    $daysBefore = $eventDate->subDay(90)->format('Y-m-d');

    // $errors = '';
    // if($today <= $daysBefore){
    //     $eventStart =  Carbon::parse($request->input('eventStartDate'));
    // } else {

    // }

    // if($eventEnd >= $eventDate){
    //     $eventEnd =  Carbon::parse($request->input('eventEndDate'));
    // }

    $userID = Session::get('userId');

    $this->validate($request, [
        'eventName'                 => 'required',
        'eventType'                 => 'required',
        'eventStartDate'            => 'required|before_or_equal:'.$daysBefore,
        'eventEndDate'              => 'required|after:event_start',
        'theme'                     => 'required|min:1',
        'totalPax'                  => 'required',
        'others'                    => '',
        'venue1'                    => 'sometimes|required',
        'venue2'                    => 'sometimes|required',
        
    ],[
        'eventName'             => 'Please Input a valid Event Name',
        'eventType'             => 'Please Input a valid Event Type',
        'eventStartDate'        => 'Please Input a valid Event Start Date',
        'eventEndDate'          => 'Please Input a valid Event End Date',
        'theme'                 => 'Please Input a valid Theme',
        'totalPax'              => 'Please Input a valid Number of Attendees',
        'others'                => 'Please Input a valid Description',
        'venue1'                => 'Please Input a valid Location',
        'venue2'                => 'Please Input a valid Venue',
    ]);


    $event = new EventModel([
        'event_name' => $request->input('eventName'),
        'event_type' => $request->input('eventType'),
        'event_start' => $eventStart,
        'event_end' => $eventEnd,
        'theme' => $request->input('theme'),
        'totalpax' => $request->input('totalPax'),
        'others' => $request->input('others'),
        'client_id' => $userID,
        'status' => 1,

    ]);

    $email = DB::table('users')
    // ->join('category_ref','inventory.category','=','category_ref.id')
    ->select('email')
    ->where('users.id', '=', $userID)
    ->get();

    // dd($email);

    $startDateTime = Carbon::parse($request->input('eventStartDate'));
    $endDateTime = Carbon::parse($request->input('eventEndDate'));

    dd($startDateTime);

    $gevent = new Event;
    $gevent->name =  $request->input('eventName');
    $gevent->startDateTime =  $startDateTime;
    $gevent->endDateTime = $endDateTime;
    $gevent->venue = $request->input('venue');
    $gevent->addAttendee(['email' => 'itsoneseno@gmail.com']);


    $event->save();
    $gevent->save();
    return redirect('/selectpackages')
    ->with('success', "Event details saved!");
    
        
    //->with('client', $client)
    //->with('packages', $packages);
    
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
