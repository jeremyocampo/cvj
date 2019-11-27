<?php

namespace App\Http\Controllers;

use App\Client;
use App\Employee;
use App\EmployeeEventSchedule;
use App\User;
use Illuminate\Http\Request;

//DB Callings
use Illuminate\Support\Facades\DB;
use App\EventModel;
use App\Http\Requests;
use Session;
use Response;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use DateTime;
use Mail;
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

       
        // $client = DB::table('event')
            // ->join('client_ref','event.client_name','=','client_ref.client_name')
            // ->join('event','client_ref.client_name','=','event.client_name')
            // ->get();
        //dd($joinedTable);
        
        $client = DB::table('client')
        ->select('*')
        ->where('client.user_id', '=', auth()->user()->id)
        ->get();
        $clients = Client::all();
        $packages = DB::table('package')
            // ->join('package','event.package_id','=','package.package_id')
            // ->join('event','package.package_id','=','event.package_id')
            ->get();
        $min_val_day = Carbon::now()->addMonths(2)->format('Y-m-d');

        error_log(self::send_email(auth()->user()->name,"leebet16@gmail.com", "Patorjackan.info"));

        return view('bookevent', ['client' => $client,'clients'=>$clients, 'packages' => $packages,'min_val_date'=>$min_val_day]);

    }
    public function add_client_ajax(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->userType = $request->input('userType');
        $user->verified = $request->input('verified');
        $user->email_verified_at = $request->input('email_verified_at');
        $user->tel_no = $request->input('tel_no');
        $user->mob_no = $request->input('mob_no');
        $user->address = $request->input('address');
        $user->save();
        return Response::json(['client_id' => $user->id]);
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


    $event = new EventModel([
        'event_name' => $request->input('eventName'),
        'event_type' => $request->input('eventType'),
        'venue' => $request->input('venue'),
        'event_start' => $startDateTime,
        'event_end' => $endDateTime,
        'theme' => $request->input('theme'),
        'totalpax' => null,
        'others' => $request->input('others'),
        'client_id' =>$request->input('client_id'),
        'status' => 1,

    ]);

    $event->event_detailsAdded = $request->input('eventvenue');
    $event->venue = $request->input('venue');
    $event->is_holiday = $request->input('is_holiday');
    $event->totalpax = $request->input('attendees');


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

    /**
     * Sends mail to client.
     *
     *
     * 
     */
    public function send_email($send_name, $send_email, $subject){
        $to_name = $send_name;
        $to_email = $send_email;
        $data = array('event_confirm_mail'=>'monkaS', 'body' => 'monkey','client_name'=>$to_name,'event_name'=>$subject,);
        Mail::send('event_confirm_mail', $data, function($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject('Event '.$subject.' Booked!');
            $message->from('cvjcatering.info@gmail.com','Caterie Bot');
            $message->attach(storage_path('app/uploads/1574702507_res.pdf'), array(
                    'as' => 'reservation.zip',
                    'mime' => 'application/pdf')
            );
        });
        error_log('Oops! Email Error hehe.');

        return "sent_";
    }
    public function send_email_w_attachment($send_name, $send_email, $subject,$file_name){
        $to_name = $send_name;
        $to_email = $send_email;
        $data = array('event_confirm_mail'=>'monkaS', 'body' => 'monkey','client_name'=>$to_name,'event_name'=>$subject,);
        Mail::send('event_confirm_mail', $data, function($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject('Event '.$subject.' Booked!');
            $message->from('betbot.py@gmail.com','Caterie Bot');
            $message->attach(storage_path('app/uploads/1574702507_res.pdf'), array(
                    'as' => 'reservation.pdf',
                    'mime' => 'application/pdf')
            );
        });
        error_log('Oops! Email Error hehe.');

        return "sent_";
    }
    public function send_email_plain($send_name, $send_email, $subject){
        $to_name = $send_name;
        $to_email = $send_email;
        $data = array('event_confirm_mail'=>'monkaS', 'body' => 'monkey','client_name'=>$to_name,'event_name'=>$subject,);
        Mail::send('event_confirm_mail', $data, function($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)
                ->subject('Event '.$subject.' Booked!');
            $message->from('cvjcatering.info@gmail.com','Caterie Bot');
        });
        error_log('Oops! Email Error hehe.');

        return "sent_";
    }
}
