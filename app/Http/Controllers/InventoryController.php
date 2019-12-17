<?php

namespace App\Http\Controllers;

use App\Supplier;
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
     * @var ValidatorUtil
     */
    private $validatorUtil;


    /**
     * Display a listing of the resource.
     *
     * @param  ValidatorUtil  $validatorUtil
     */

    public function __construct(ValidatorUtil $validatorUtil)
    {
        $this->middleware('auth');
        $this->validatorUtil = $validatorUtil;
    }
    
    public function index()
    {
        //
        $joinedTable = DB::table('inventory')
            // // ->join('category_ref','inventory.category','=','category_ref.id')
            // ->join('inventory','category_ref.category_no','=','inventory.category')
            ->join('category_ref', 'inventory.category', '=', 'category_ref.category_no')
            ->join('color','inventory.color','=','color.color_id')
            ->join('size','inventory.size', '=', 'size.size_id')
            ->whereNull('inventory.deleted_at')
            ->get();
        // dd($joinedTable);

        $criticalInventory = DB::select(DB::raw('select * from cvjdb.inventory where quantity <= threshold'));
        // ->join('category_ref', 'inventory.category', '=', 'category_ref.category_no');
        // $criticalInventory = DB::table('inventory')
        // // ->join('category_ref', 'inventory.category', '=', 'category_ref.category_no')
        // ->select('*')
        // ->where('inventory.quantity', '<=', 'inventory.threshold')
        // ->get();

        // dd($criticalInventory);

        $month = Carbon::now()->format('F');

        return view('inventory', ['joinedInventory' => $joinedTable, 'criticalInventory' => $criticalInventory, 'month' => $month]);
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


        $colors = DB::table('color')->get();
        $suppliers = Supplier::all();
        $sizes = DB::table('size')->get();


        return view('addInventoryForm', ['categories' => $category_ref, 'colors' => $colors, 'suppliers' => $suppliers, 'sizes' => $sizes]);
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

            $minTh = $quantity*.10;
            $minP = 1.00;
        
            $this->validate($request, [
                'inventory_name'      => 'required',
                'category'      => 'required|min:1',
                'quantity'      => 'required|numeric|min:1',
                'threshold'     => 'required|numeric|min:'.$minTh,
                'color'         => 'required|min:1',
                'price'         => 'required|min:'.$minP,
            ],[
                'inventory_name.required'     => 'Please Input a Valid Inventory Name.',
                'category.required'     => 'Please Select a Category.',
                'quantity.required'     => 'Please input a valid Quantity',
                'subcategory.required'  => 'Please Select a Sub-Category.',
                'threshold,required'    => 'Please Input a valid Threshold Amount',
                'threshold.min'         => 'Please Input a Threshold Amount at least 50% of Starting Quantity',
            ]);

            $similar_inventory = $this->validatorUtil->validateInventory($request->post('inventory_name'), $request->post('category'),
                $request->post('color'), $request->post('size'));

            if ($similar_inventory){

                return redirect()->back()->with('warning', 'Inventory Already Exists!');
            }

            $inventory = new inventory();
            $inventory->inventory_name = $request->input('inventory_name');
            $inventory->category = $request->input('category');
            $inventory->quantity = $request->input('quantity');

            $inventory->sku = $faker->unique()->isbn13;
            $inventory->date_created = Carbon::now();
            $inventory->status = '1';
            $inventory->itemSource = $request->input('source');
            $inventory->color = $request->input('color');
            $inventory->threshold = $request->input('threshold');
            $inventory->price = $request->input('price');
            $inventory->size = $request->input('size');
            $inventory->supplier_id = $request->post('supplier_id');
            $inventory->shelf_life = $request->post('shelf_life');
            $inventory->returnable_item = $request->post('returnable_item');
            $inventory->save();
            
            // dd($inventory);

            return redirect('/inventory')->with('success', 'Item Added!');
        
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

        $itemInfo = DB::table('category_ref')
            ->select('*')
            ->where('inventory.inventory_id', '=', $id)
            ->join('inventory','category_ref.category_no','=','inventory.category')
            ->first();


        $category_ref = DB::table('category_ref')->get();
        $color =  DB::table('color')->get();
        $size = DB::table('size')->get();

        $suppliers = Supplier::all();

       
        return view('inventoryView', ['itemInfo' => $itemInfo, 'categories' => $category_ref, 'sizes' => $size, 'colors' => $color, 'suppliers' => $suppliers]);

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
        ->first(); //return 1


        $category = DB::table('category_ref')
        ->select('category_name')
        ->where('inventory_id', '=', $id)
        ->join('inventory','category_ref.category_no','=','inventory.category')
        ->get();



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


        if ($request->has('update_inventory')){

            $quantity = $request->input('quantity');
            $threshold  = $request->input('threshold');

            $minTh = $quantity/2;

            $this->validate($request, [
                'inventory_name'      => 'required',
                'category'      => 'required|min:1',
                'quantity'      => 'required|numeric|min:1',
                'threshold'     => 'required|numeric|min:'.$minTh,
                'status'        => 'required|numeric|min:0',
                'supplier' => 'required',
                'shelf_life' => 'required|numeric|min:0',
                'returnable_item' => 'required',
                'description'    => 'required',
            ],[
                'inventory_name.required'     => 'Please Input a Valid Item Name.',
                'category.required'     => 'Please Select a Category.',
                'quantity.required'     => 'Please input a valid Quantity',
                'threshold,required'    => 'Please Input a valid Threshold Amount',
                'threshold.min'         => 'Please Input a Threshold Amount at least 50% of Starting Quantity',
                'status.required'        => 'Please select the appropriate Status for this item',
                'description.required'        => 'Please input a valid Quantity',
            ]);

            $similar_inventory = $this->validatorUtil->validateInventory($request->post('inventory_name'), $request->post('category'),
                $request->post('color'), $request->post('size'));

            if ($similar_inventory){

                return redirect()->back()->with('warning', 'Inventory Already Exists!');
            }



            $item = DB::table('inventory')
                ->where('inventory_id', '=', $id)
                ->update([
                    'inventory_name' => $request->input('inventory_name'),
                    'category'      => $request->input('category'),
                    'quantity'      => $request->input('quantity'),
                    'last_modified' => Carbon::now('+8:00'),
                    'status'        => $request->input('status'),
                    'threshold'     => $request->input('threshold'),
                    'shelf_life' => $request->post('shelf_life'),
                    'returnable_item' => $request->post('returnable_item'),
                    'supplier_id' => $request->post('supplier'),
                    'description' => $request->post('description'),
                ]);


            return redirect('/inventory')->with('success', 'Item Updated');
        }


        $quantity = $request->input('quantity');
        $threshold  = $request->input('threshold');

        $minTh = $quantity/2;
    
        $this->validate($request, [
            'quantity'      => 'required|numeric|min:1',
        ],[
            'quantity.required'     => 'Please input a valid Quantity',
        ]);



        $item = DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->increment('quantity', $request->post('quantity'));
        
        
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
        DB::table('inventory')
        ->where('inventory_id', '=', $id)
        ->update([
            'deleted_at' => Carbon::now()
        ]);
        
        return redirect('/inventory')->with('delete', 'Item Disabled');
    }

    public function selectType(Request $request){

        return $request->input('itemType');
    }

    public function deploy(){
        return 1;
    }

    public function editRecord($id){

         //
    }

    public function archive()
    {
        $inventories = DB::table('inventory')
            ->join('category_ref', 'inventory.category', '=', 'category_ref.category_no')
            ->join('color','inventory.color','=','color.color_id')
            ->join('size','inventory.size', '=', 'size.size_id')
            ->whereNotNull('inventory.deleted_at')
            ->get();

        return view('archive-inventory', compact('inventories'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function recover($id)
    {
        DB::table('inventory')
            ->where('inventory_id', $id)
            ->update([
                'last_modified' => Carbon::now(),
                'deleted_at' => null
            ]);

        return redirect('/archive')->with('success', 'Item Recovered');

    }
}
