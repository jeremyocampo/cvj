<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\inventory;
use App\categoryRef;
use App\OutsourcedItem;
use App\Package;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;

class EventsCostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$event = Event::get();
        return view('eventCosting');
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $event = Event::where('event_name', '=',$id)->first();
        $total =0;
        $event_costing = DB::table('event_costing')->where('event_name', '=',$id)->first();
        $outsourced_items = DB::table('event_outsource_item')->where('event_name', '=',$id)->get();

        error_log($event);
        foreach($outsourced_items as $item){
            $total += $item->total_price;
        }
        return view('eventCosting',
        ['outsourced_items' => $outsourced_items,'event'=>$event,'event_costing'=>$event_costing,'event_name'=>$id,'total_outsource'=>$total]);
    }

    public static function getOutsourceItem_by_Id($id){
        return $outsource_item = DB::table('outsourced_item')->where('outsourced_item_id', '=',$id)->first();
    }
    public static function getSupplier_by_Id($id){
       return $supplier = Supplier::where('supplier_id', '=',$id)->first();
    }

    public static function getPackage_by_Id($id){
        return $supplier = Package::where('package_id', '=',$id)->first();
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


    }
        //

}
