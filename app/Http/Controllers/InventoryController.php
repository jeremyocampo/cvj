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

class InventoryController extends Controller
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
        $joinedTable = DB::table('category_ref')
            // ->join('category_ref','inventory.category','=','category_ref.id')
            ->join('inventory','category_ref.category_no','=','inventory.category')
            ->get();
        //dd($joinedTable);

        $criticalInventory = DB::select('select * from cvjdb.inventory where quantity <= threshold;');

        return view('inventory', ['joinedInventory' => $joinedTable, 'criticalInventory' => $criticalInventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category_ref = DB::table('category_ref')->get();

        // $subcategory_ref = DB::table('subcategory_ref')->get();

        $colors = DB::table('color')->get();

        //dd($subcategoryNames);

        // return view('addInventoryForm', ['categories' => $category_ref, 'subcategoryIds' => $subcategoryIds, 'subcategoryNames' => $subcategoryNames]);
        return view('addInventoryForm', ['categories' => $category_ref, 'colors' => $colors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faker $faker)
    {
            $quantity = $request->input('quantity');
            $threshold  = $request->input('threshold');

            $minTh = $quantity/2;
            $minP = 1.00;
        
            $this->validate($request, [
                'itemName'      => 'required',
                'category'      => 'required|min:1',
                'quantity'      => 'required|numeric|min:1',
                'source'        => 'required|min:1',
                'threshold'     => 'required|numeric|min:'.$minTh,
                'color'         => 'required|min:1',
                'price'         => 'required|min:'.$minP,
            ],[
                'itemName.required'     => 'Please Input a Valid Item Name.',
                'category.required'     => 'Please Select a Category.',
                'quantity.required'     => 'Please input a valid Quantity',
                'source.required'       => 'Please Select a Source',
                'subcategory.required'  => 'Please Select a Sub-Category.',
                'threshold,required'    => 'Please Input a valid Threshold Amount',
                'threshold.min'         => 'Please Input a Threshold Amount at least 50% of Starting Quantity',
            ]);

            $inventory = new inventory();
            $inventory->inventory_name = $request->input('itemName');
            $inventory->category = $request->input('category');
            $inventory->quantity = $request->input('quantity');

            $inventory->sku = $faker->unique()->isbn13;
            $inventory->date_created = Carbon::now();
            $inventory->status = '1';
            $inventory->itemSource = $request->input('source');
            $inventory->color = $request->input('color');
            $inventory->threshold = $request->input('threshold');
            $inventory->price = $request->input('price');
            //$inventory->last_modified = Carbon::now();
            $inventory->save();
            
            return redirect('/inventory')->with('success', 'Item Added!');
        
    }

    /**
     * Display the specified resource.hhthrrejajgoeaibijgntoeaofineoaniivnomrnninalnuentamaimeuguop ihean
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $itemInfo = DB::table('category_ref')
            // ->join('category_ref','inventory.category','=','category_ref.id')
            ->select('*')
            ->where('inventory.inventory_id', '=', $id)
            ->join('inventory','category_ref.category_no','=','inventory.category')
            ->get();
        //dd($joinedTable);

        $category_ref = DB::table('category_ref')->get();

        $color =  DB::table('color')->get();

        $size = DB::table('size')->get();
       
        // $subcategory = DB::table('subcategory_ref')
        //     ->select('subcategory')
        //     ->where('subcategory', '>', 0);
        //dd($itemInfo);
        // dd($color);
        return view('inventoryView', ['itemInfo' => $itemInfo, 'categories' => $category_ref, 'sizes' => $size, 'colors' => $color]);

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

        $item = DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->get();
        
        $category = DB::table('category_ref')
        ->select('category_name')
        ->where('inventory_id', '=', $id)
        ->join('inventory','category_ref.category_no','=','inventory.category')
        ->get();

       

        //   dd($item);
        //   dd($category);
        return view('replenishInventory', ['items' => $item, 'category' => $category]);
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

        $quantity = $request->input('quantity');
        $threshold  = $request->input('threshold');

        $minTh = $quantity/2;
    
        $this->validate($request, [
            'itemName'      => 'required',
            'category'      => 'required|min:1',
            'quantity'      => 'required|numeric|min:1',
            'source'        => 'required|min:1',
            'threshold'     => 'required|numeric|min:'.$minTh,
            'status'        => 'required|numeric|min:0',
        ],[
            'itemName.required'     => 'Please Input a Valid Item Name.',
            'category.required'     => 'Please Select a Category.',
            'quantity.required'     => 'Please input a valid Quantity',
            'source.required'       => 'Please Select a Source',
            'threshold,required'    => 'Please Input a valid Threshold Amount',
            'threshold.min'         => 'Please Input a Threshold Amount at least 50% of Starting Quantity',
            'status.required'        => 'Please select the appropriate Status for this item',
        ]);
        
        //dd($request->input('category'));

        // $newQuantity = DB::table('inventory')
        // ->select('quantity')
        // ->where('inventory_id', '=', $id)
        // ->get();

        //$newQuantity = $newQuantity[0]->quantity + $request->input('quantity');

        
        $item = DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->update([
            'inventory_name'      => $request->input('itemName'),
            'category'      => $request->input('category'),
            'quantity'      => $request->input('quantity'),
            'last_modified' => Carbon::now(),
            'status'        => $request->input('status'),
            'itemSource'        => $request->input('source'),
            'threshold'     => $request->input('threshold'),
        ]);
        
        
        return redirect('/inventory')->with('success', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function view(){

        $id = session()->get( 'id' );

        
     }

    public function destroy($id)
    {
        //
        // return alert('Are you sure you want to Continue?');

        $item = DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->update([
            'status' => '0',
            'last_modified' => Carbon::now(),
        ]);
        
        return redirect('/inventory')->with('delete', 'Item Disabled');
    }

    public function selectType(Request $request){

        return $request->input('itemType');
    }

    public function deploy(){
        return 1;
    }
}