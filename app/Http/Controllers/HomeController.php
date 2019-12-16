<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\userModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('admin');
        // dd(auth()->user()->userType );
        if(auth()->user()->userType == 1){

            $users = DB::table('users')
            ->select('*')
            ->where('users.status', '>', 0)
            ->orderBy('created_at','desc')
            ->take(5)
            ->get();

            // $from = Carbon::now();
            // $to = Carbon::now()->addDays(7);

            // $users = userModel::whereBetween('created_at', [$from, $to])
            // ->orderBy('created_at', 'desc')
            // ->get();
    
            return view('adminDashboard', ['users' => $users]);

        } else if (auth()->user()->userType == 2){

            $criticalInventory = DB::select('select * from cvjdb.inventory where quantity <= threshold;');

            $event = DB::table('event')
            // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->join('event_status_ref', 'event.status', '=', 'event_status_ref.status_id')
            ->select('*')
            ->get();

            $date = Carbon::now()->format('Y-m-d');
            // dd($date);

            // $check = (Carbon::parse($date)->gt($event[0]->event_start));
            $events = array();

            foreach($event as $i){
                if(Carbon::parse($i->event_start)->format('Y-m-d') == $date){
                    array_push($events, $i);
                }
            }

            // dd($eventArr);
            

            return view('inventoryDashboard',['events' => $events, 'criticalInventory' => $criticalInventory]);

        } else if(auth()->user()->userType == 3){

            return redirect('events');

        }  else if(auth()->user()->userType == 4){

            
            
        }  else if(auth()->user()->userType == 5){

            // $user = auth()->user()->id;

            // $events = DB::table('event')
            // ->select('*')
            // // ->where('event.client_id', '=', $user)
            // ->get(); 

            // // $events::where('client_id', $user)->get();

            // // dd($user);
            // // dd($events);
            // return view('clientDashboard', ['events' => $events]);

            return redirect('bookevent');
            
        }
    }

    public function mail()
    {
        $mail = 'Oh hello this is you and i am you. He. He.';
        Mail::to('jeremy_ocampojr@dlsu.edu.ph')->send(new SendMailable($mail));
        
        return redirect('/home')->with('success', 'Your account and booking has been successfully created. Please check your email.');
    }
}
