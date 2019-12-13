<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use App\inventory;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use App\damaged_inventory;

class ExpenseReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events = DB::table('event')
        ->select('*')
        ->join('package','event.package_id','=','package.package_id')
        // ->join('event_client_quotation', 'event.event_id','=','event_client_quotation.event_id')
        // ->join('event_company_quotation', 'event.event_id','=','event_company_quotation.event_id')
        // ->join('event_costing')
        // ->where('status','=', 5)
        ->get();

        // dd($events);

        return view('expenseReports',['events' => $events]);
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
