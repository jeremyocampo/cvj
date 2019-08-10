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

        $outsource = DB::table('event_outsource_item')
        ->join('event', 'event_outsource_item.event_id', '=', 'event.event_id')
        ->join('outsourced_item', 'event_outsource_item.outsourced_item_id', '=', 'outsourced_item.outsourced_item_id')
        ->join('supplier', 'outsourced_item.supplier_id', '=', 'supplier.supplier_id')
        ->where('event_outsource_item.status', '=')
        ->get();

        return view('outsource', ['outsource' => $outsource]);
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

        return view('addOutsource',['outsource' => $outsource]);
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
        return view('viewOutsource')
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
}
