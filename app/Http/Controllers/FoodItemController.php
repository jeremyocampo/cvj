<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use App\EmployeeEventSchedule;
use App\Event;
use App\EventDishes;
use App\EventInventory;
use App\EventModel;
use App\events;
use App\inventory;
use App\Client;
use App\Items;
use App\User;
use App\PackageInventory;
use App\PackageItem;
use App\Dish;
use Carbon\Carbon;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use Session;

use PDF;
use Illuminate\Support\Facades\Auth;

class FoodItemController extends Controller
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
        $dishes = DB::table('items')
        ->select('*')
        ->where('disabled_at','=', null)
        ->get();

        // dd($dishes);

        return view('foodList', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('addFood');
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
        $this->validate($request, [
            'item_name'      => 'required',
            'unit_cost'      => 'required|min:1',
            'unit_expense'      => 'required|numeric|min:1',
            'image'     => 'required|',
        ],[
            'inventory_name.required'     => 'Please Input a Valid Inventory Name.',
            'category.required'     => 'Please Select a Category.',
            'quantity.required'     => 'Please input a valid Quantity',
            'subcategory.required'  => 'Please Select a Sub-Category.',
            'threshold,required'    => 'Please Input a valid Threshold Amount',
            'threshold.min'         => 'Please Input a Threshold Amount at least 50% of Starting Quantity',
        ]);

        $items = new Items();
        $items->item_name = $request->input('foodName');
        $items->unit_cost = $request->input('unit_cost');
        $items->unit_expense = $request->input('unit_expense');
        $items->item_image = $request->input('image');
        $items->save();

        return redirect('/fooditem')->with('success', 'Item Added!');

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
        DB::table('items')
        ->where('item_id', '=', $id)
        ->update([
            'disabled_at' => Carbon::now('+8:00')
        ]);
        
        return redirect('/fooditem')->with('delete', 'Item Disabled');
    }

    public function disabled(){

        // $data['dishes'] = Dish::onlyTrashed()->get();
        $data['dishes'] = DB::table('items')
        ->where('disabled_at','!=', null)
        ->get();

        return view('food-disabled', $data);

    }

    public function recoverItem($id){


        $restore = DB::table('items')
        ->where('item_id','=', $id)
        ->update([
            'disabled_at' => null,
        ]);

        return redirect('/disabled-food')->with('success', 'Dish Enabled');

    }
}
