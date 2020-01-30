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
            // $criticalInventory = DB::table('inventory')
            // ->where('inventory.quantity', '<=' , 'inventory.threshold')
            // ->get();

            $event = DB::table('event')
            ->join('event_status_ref', 'event.status', '<=', 'event_status_ref.status_id')
            ->select('*')
            ->get();

            $currDate = Carbon::now('+8:00');
            $dateToday = Carbon::now('+8:00')->format('Y-m-d');

            $events = array();
            $upcomingEvents = array();

            foreach($event as $i){
                if(Carbon::parse($i->event_start)->format('Y-m-d') == $dateToday){
                    if($i->status >= 3){
                        array_push($events, $i);
                    }
                } 
                else if (Carbon::parse($i->event_start)->format('Y-m-d') > $dateToday){
                    if($i->status == 3){
                        array_push($upcomingEvents, $i);
                    }
                }
            }

            return view('inventoryDashboard',['eventsToday' => $events, 'criticalInventory' => $criticalInventory, 'currDate' => $currDate, 'upcomingEvents' => $upcomingEvents]);

        } else if(auth()->user()->userType == 3){
            //events manager
            return redirect('bookevent');

        }  else if(auth()->user()->userType == 4){
            //operations manager
            return redirect('list_events');
            
        }  else if(auth()->user()->userType == 5){

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
