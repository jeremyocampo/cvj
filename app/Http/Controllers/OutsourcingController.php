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

class OutsourcingController extends Controller
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
    
    public function index()
    {
        //

        // $outsource = DB::table('event_outsource_item')
        // ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        // ->join('outsourced_item', 'event_outsource_item.outsourced_item_id', '=', 'outsourced_item.outsourced_item_id')
        // ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        // ->where('event_outsource_item.status', '=', 'Ordered')
        // ->get();

        // $outsource = DB::table('event')
        // // ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        // ->join('event_outsource_item', 'event.event_id', '=', 'event_outsource_item.event_id')
        // ->join('outsourced_item', 'event_outsource_item.outsourced_item_id', '=', 'outsourced_item.outsourced_item_id')
        // ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        // // ->join('inventory', 'outsourced_item.item_name', '=', 'inventory.inventory_name')
        // ->where('event_outsource_item.status', '=', 'Ordered')
        // ->get();

        $outsource = DB::table('inventory')
        // ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        // ->join('event_outsource_item', 'event.event_id', '=', 'event_outsource_item.event_id')
        
        ->join('outsourced_item', 'inventory.inventory_name', '=', 'outsourced_item.item_name')
        ->join('event_outsource_item', 'outsourced_item.outsourced_item_id', '=', 'event_outsource_item.outsourced_item_id')
        ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        // ->join('inventory', 'outsourced_item.item_name', '=', 'inventory.inventory_name')
        ->where('event_outsource_item.status', '=', 'Ordered')
        // ->where('inventory.inventory_id', '=', 'outsourced_item.inventory_id')
        ->select('*')
        ->get();

        $needToOutsource = DB::table('event')
        // ->join('event_inventory', 'event.event_id', '=', 'event_inventory.event_id')
        // ->join('inventory', 'event_inventory.inventory_id', '=', 'inventory.inventory_id')
        ->join('package', 'event.package_id', '=', 'package.package_id')
        // ->where('event_inventory.full', '=', 0)
        ->where('event.event_full', '=', 0)
        ->where('event.status', '<', 4)
        ->get();

        // dd($outsource, $needToOutsource);

        return view('outsource', ['outsource' => $outsource, 'needed' => $needToOutsource]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outsource = DB::table('event_outsource_item')
        ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        ->join('outsourced_item', 'event_outsource_item.outsourced_item_id', '=', 'outsourced_item.outsourced_item_id')
        ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        ->get();

        $inventory = DB::table('inventory')
        ->select('*')
        ->join('event_inventory', 'inventory.inventory_id', '=', 'event_inventory.inventory_id')
        ->get();
        // dd($outsource);
        // dd($inventory);

        return view('addOutsource',['outsource' => $outsource, 'items' => $inventory]);
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
        
        self::send_email(auth()->user()->name,"jeremy_ocampojr@dlsu.edu.ph", $request->input('eventName'));
        return redirect('/outsource');
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
        $outsource = DB::table('event_outsource_item')  
        ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        ->join('outsourced_item', 'event_outsource_item.outsourced_item_id', '=', 'outsourced_item.outsourced_item_id')
        ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        ->get();

        return view('viewOutsource',['outsource' => $outsource]);
;    }

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
        return redirect('/outsource');
    }

    /**
     * Emails the Supplier about the outsource
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
        });
        error_log('Oops! Email Error hehe.');

        return "sent_";
    }
}
