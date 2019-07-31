<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//DB Callings
use Illuminate\Support\Facades\DB;
use App\EventModel;
use App\Http\Requests;
use Session;

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
   
    $event = new EventModel([
        'client_id' => $loginDet['client_id'],
        'event_name' => $request->input('eventName'),
        'event_date_time' => $request->input('eventDate'),
         'reservation_id' => $request->input('eventVenue'),
        //Event Type Selection
        'eventType' => $request->input('event_type'),
        'theme' => $request->input('theme'),
        'centerpiece' => $request->input('centerpiece'),
        'flowers' => $request->input('flowers'),
        'linencolor' => $request->input('linencolor'),
        'chair' => $request->input('chair'),
        'table' => $request->input('table'),
        'others' => $request->input('others'),
        'totalpax' => $request->input('totalpax'),

    ]);
    $event->save();
        
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
