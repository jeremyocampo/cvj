<?php

namespace App\Http\Controllers;

use App\Charts\EventCharts;
use App\Charts\InventoryCharts;
use App\deployed_inventory;
use App\Event;
use App\lost_inventory;
use App\Manpower;
use App\Manpowers;
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
    public function index(Request $request)
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

            /*
             * reports charts
             */

            $totalEvents = Event::all()->count();
            $totalManpower = Manpowers::all()->count();
            $totalExpenses = Manpower::all()->sum('salary');
            $totalInventory = inventory::all()->count();

            if ($request->get('filter') === 'monthly' || !$request->has('filter')){
                $eventBooking = Event::all()->groupBy(function ($q){
                    return Carbon::parse($q->event_start)->format('M');
                });


                $events = new EventCharts;
                $label = [];
                foreach ($eventBooking as $key => $value){
                    $label[] .= $key;
                }

                foreach ($eventBooking as $key => $value){
                    $events->labels(["Peak Events"]);
                    $events->dataset($key, 'bar', [count($value)]);
                }


                $inventoryData = inventory::all()->groupBy(function ($q){
                    return Carbon::parse($q->date_created)->format('M');
                });


                $inventory = new InventoryCharts;
                foreach ($inventoryData as $key => $value){
                    $inventory->labels(["Peak Inventory"]);
                    $inventory->dataset($key, "bar", [count($value)]);
                }
            } else if($request->get('filter') === 'weekly'){

                $eventBooking = Event::all()->sortBy('event_start')->groupBy(function ($q){
                    return Carbon::parse($q->event_start)->format('d');
                });

                $events = new EventCharts;
                $label = [];
                foreach ($eventBooking as $key => $value){
                    $label[] .= $key;
                }

                foreach ($eventBooking as $key => $value){
                    $events->labels(["Peak Events"]);
                    $events->dataset("Week". $key, 'bar', [count($value)]);
                }


                $inventoryData = inventory::all()->groupBy(function ($q){
                    return Carbon::parse($q->date_created)->format('d');
                });


                $inventory = new InventoryCharts;
                foreach ($inventoryData as $key => $value){
                    $inventory->labels(["Peak Inventory"]);
                    $inventory->dataset($key, "bar", [count($value)]);
                }
            }
            else if($request->get('filter') === 'daily'){

                $eventBooking = Event::all()->sortBy('event_start')->groupBy(function ($q){
                    return Carbon::parse($q->event_start)->format('Y-m-d');
                });


                $events = new EventCharts;
                $label = [];
                foreach ($eventBooking as $key => $value){
                    $label[] .= $key;
                }

                foreach ($eventBooking as $key => $value){
                    $events->labels(["Peak Events"]);
                    $events->dataset(Carbon::parse($key)->format('F g, Y'), 'bar', [count($value)]);
                }


                $inventoryData = inventory::all()->groupBy(function ($q){
                    return Carbon::parse($q->date_created)->format('Y-m-d');
                });


                $inventory = new InventoryCharts;
                foreach ($inventoryData as $key => $value){
                    $inventory->labels(["Peak Inventory"]);
                    $inventory->dataset(Carbon::parse($key)->format('F g, Y'), "bar", [count($value)]);
                }
            }

            // $lostInventory = lost_inventory::whereYear('date_reported', Carbon::parse()->format('Y'))->distinct('inventory_deployed')->get()->sortByDesc('id')->take(10);
            // $deployed = deployed_inventory::whereYear('date_deployed', Carbon::parse()->format('Y'))->distinct('inventory_deployed')->get()->take(5);
            // $deployed = DB::select(DB::raw('select *, count(*) as noOfTimesDeployed from deployed_inventory group by inventory_deployed order by noOfTimesDeployed desc'));
            
            // $deployed = DB::table('deployed_inventory')
            // ->select('*', 'count(*) AS noOfTimesDeployed')
            // ->groupBy('inventory_deployed')
            // ->orderBy('noOfTimesDeployed')
            // ->get();

            $deployed = DB::table('deployed_inventory')
            ->join('inventory', 'deployed_inventory.inventory_deployed', '=' , 'inventory.inventory_id')
            ->select('deployed_inventory.inventory_deployed',DB::raw('count(*) AS qty '), 'inventory.inventory_name')
            ->groupBy('deployed_inventory.inventory_deployed', 'inventory.inventory_name')
            ->orderBy('qty', 'desc')
            ->get();

            $lostInventory = DB::table('damaged_inventory')
            ->join('inventory', 'damaged_inventory.inventory_deployed', '=' , 'inventory.inventory_id')
            ->select('damaged_inventory.inventory_deployed',DB::raw('count(*) AS qty '), 'inventory.inventory_name')
            ->groupBy('damaged_inventory.inventory_deployed', 'inventory.inventory_name')
            ->orderBy('qty', 'desc')
            ->get();

            // dd($deployed);

            // $deployed = DB::table('deployed_inventory')
            // ->get();

            



            return view('adminDashboard', ['users' => $users, 'totalEvents' => $totalEvents, 'manpower' => $totalManpower,
                'expenses'=> $totalExpenses, 'totalInventory' => $totalInventory, 'events' => $events, 'inventory' => $inventory,
                'lostInventory' => $lostInventory, 'deployed' => $deployed]);

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
