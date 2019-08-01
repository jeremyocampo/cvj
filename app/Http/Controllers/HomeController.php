<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;

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
        if(auth()->user()->userType == 1){

            return view('adminhome');

        } else if (auth()->user()->userType == 2){
            
            $criticalInventory = DB::select('select * from cvjdb.inventory where quantity <= threshold;');

            $event = DB::table('event')
            ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
            ->select('*')
            ->get();
            
            return view('inventoryDashboard',['events' => $event, 'criticalInventory' => $criticalInventory]);
        } else if(auth()->user()->userType == 3){

            return view('bookevent');

        }  else if(auth()->user()->userType == 4){


            
        }  else if(auth()->user()->userType == 5){


            
        }
    }
}
