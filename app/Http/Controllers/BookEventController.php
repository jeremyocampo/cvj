<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeEventSchedule;
use Illuminate\Http\Request;

//DB Callings
use Illuminate\Support\Facades\DB;
use App\EventModel;
use App\Http\Requests;
use Session;
<<<<<<< HEAD
use Response;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use Mail;
=======

>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
class BookEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       
        $client = DB::table('event')
            // ->join('client_ref','event.client_name','=','client_ref.client_name')
            // ->join('event','client_ref.client_name','=','event.client_name')
            ->get();
        //dd($joinedTable);
        
<<<<<<< HEAD
        $client = null;
        
=======
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
        $packages = DB::table('package')
            // ->join('package','event.package_id','=','package.package_id')
            // ->join('event','package.package_id','=','event.package_id')
            ->get();
<<<<<<< HEAD
        $min_val_day = Carbon::now()->addMonths(2)->format('Y-m-d');
        return view('bookevent', ['client' => $client, 'packages' => $packages,'min_val_date'=>$min_val_day]);
    }

    
    public function checkDateValidity($startDate){
        //get number of events for that day, if 10 return invalid.
        $d = new DateTime($startDate);
        $events = EventModel::whereDate('event_start','=',$d)->get();
        if(count($events) <= 0){
            return Response::json(['valid' => true,'event_count'=>count($events)]);
        }
        return Response::json(['valid' => false,'event_count'=>count($events)]);
    }
=======

        return view('bookevent', ['clients' => $client, 'packages' => $packages]);
    }


>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
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

    //dd($request['eventType']);
    // $loginDet = [
    //     "client_id" => "princessdelapaz",
    //     "password" => "123456"
    // ];

    // Session::put('loginDetails', $loginDet);
    // $loginDetails = Session::get('loginDetails');
<<<<<<< HEAD
    // $client_id = 1;
    $today = Carbon::now('+8:00');

    $eventDate =  Carbon::parse($request->input('eventStartDate'));
//    $eventEnd = Carbon::parse($request->input('eventEndDate'))->format('Y-m-d');

    //$daysBefore = $eventDate->subDay(90)->format('Y-m-d');
    $daysBefore1 = $today->addDay(90)->format("Y-m-d");

    // $errors = '';
    // if($today <= $daysBefore){
    //     $eventStart =  Carbon::parse($request->input('eventStartDate'));
    // } else {

    // }

    // if($eventEnd >= $eventDate){
    //     $eventEnd =  Carbon::parse($request->input('eventEndDate'));
    // }

    

    $this->validate($request, [
        'eventName'                 => 'required',
        'eventType'                 => 'required',
    //    'eventStartDate'            => 'required|after_or_equal:'.$daysBefore1,
    //    'eventEndDate'              => 'required|after:eventStartDate',
        'theme'                     => 'required|min:1',
       'email'                  => 'required|email',
        'others'                    => '',
        'venue'                    => 'required',
        
    ],[
        'eventName'             => 'Please Input a valid Event Name',
        'eventType'             => 'Please Input a valid Event Type',
        'eventStartDate'        => 'Please Input a valid Event Start Date',
    //    'eventEndDate'          => 'Please Input a valid Event End Date',
        'theme'                 => 'Please Input a valid Theme',
       'email.required'              => 'Please Input a valid Client Email Address',
       'email.email'            => 'Please Input a valid Client Email Address',
        'others'                => 'Please Input a valid Description',
        'venue'                => 'Please Input a valid Venue',
    ]);

    $startDateTime = Carbon::parse($request->input('eventStartDate')." ".$request->input('startTime'));
    $endDateTime = Carbon::parse($request->input('eventStartDate')." ".$request->input('endTime'));

    
    error_log("awit: ".$request->input('venue'));
    error_log("awit: ".$request->input('theme'));


=======
   
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
    $event = new EventModel([
        'client_id' => $loginDet['client_id'],
        'event_name' => $request->input('eventName'),
        'event_date_time' => $request->input('eventDate'),
         'reservation_id' => $request->input('eventVenue'),
        //Event Type Selection
        'eventType' => $request->input('event_type'),
        'theme' => $request->input('theme'),
<<<<<<< HEAD
        'totalpax' => null,
=======
        'centerpiece' => $request->input('centerpiece'),
        'flowers' => $request->input('flowers'),
        'linencolor' => $request->input('linencolor'),
        'chair' => $request->input('chair'),
        'table' => $request->input('table'),
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
        'others' => $request->input('others'),
        'totalpax' => $request->input('totalpax'),

    ]);
<<<<<<< HEAD

    $event->event_detailsAdded = $request->input('eventvenue');
    $event->venue = $request->input('venue');
    $event->is_holiday = $request->input('is_holiday');


    $email = auth()->user()->email;

    $clientEmail = $request->input('email');
    
    $client = DB::table('client')
    ->select('client_id')
    ->where('client.email', '=', $clientEmail)
    ->first();

    $event->client_id = $client;
 
    dd($client);

    // G EVENT TEMPORARILY SUSPENDED
    // $emailAdd = $email[0]->email; 
    
    // dd($email);

    // dd($startDateTime);
    /* commenting google events for now.
    $gevent = new Event;
    $gevent->name =  $request->input('eventName');
    $gevent->startDateTime =  $startDateTime;
    $gevent->endDateTime = $endDateTime;
    $gevent->location = $request->input('venue');
    //$gevent->maxAttendees = $request->input('totalPax');
    $gevent->addAttendee(['email' => $email]);

    // dd($gevent);
    $event->save();
    $gevent->save();
    */

    $event->save();
    //error_log("data: ".$request->input("emps"));

    for($i=0; $i<count($request->input("emps"));$i++){
        error_log("data: ".$request->input("emps")[$i]);

        $sched = new EmployeeEventSchedule();
        $sched->employee_id= $request->get("emps")[$i];
        $sched->event_id= $event->event_id;
        $sched->event_date_time = $event->event_start;
        $sched->save();

    }

    //self::send_email(auth()->user()->name,"jeremy_ocampojr@dlsu.edu.ph", $request->input('eventName'));
    
    return redirect('/selectpackages/' . $event->event_id)
    ->with('success', "Event details saved!");
    
=======
    $event->save();
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
        
    return redirect('/selectpackage')
    ->with('success', "Event details saved!")
    ->with('client', $client)
    ->with('packages', $packages);
    //return view('eventbookingpage.selectpackage', compact('status'));
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

        $client = DB::table('client')
        ->select('*')
        ->where('client.client_id', '=', $id)
        ->first();
        
        $packages = DB::table('package')
            // ->join('package','event.package_id','=','package.package_id')
            // ->join('event','package.package_id','=','event.package_id')
            ->get();
        $min_val_day = Carbon::now()->addMonths(2)->format('Y-m-d');

        return view('bookevent', ['client' => $client, 'packages' => $packages,'min_val_date'=>$min_val_day]);

    }

    
    public function get_available_personnel_on_date($date){
        $employees = Employee::all();
        $avail_personnel = array();
        error_log($employees);
        foreach($employees as $employee){
            $has_event = EmployeeEventSchedule::whereDate('event_date_time','=',$date)->where('employee_id','=',$employee->employee_id)->first();
            if($has_event == null){
                array_push($avail_personnel,array("emp_id"=>$employee->employee_id,"fn"=>$employee->employee_FN,"ln"=>$employee->employee_LN));
            }
        }
        return Response::json($avail_personnel);
    }
    public function save_personnel($personnel_id,$event_id){
        $sched = new EmployeeEventSchedule();
        $event = Event::where('event_id','=',$event_id)->first();
        $sched->employee_id= $personnel_id;
        $sched->event_id= $event_id;
        $sched->event_date_time = $event->event_start;
        $sched->save();
        return redirect('event_budgets');
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
