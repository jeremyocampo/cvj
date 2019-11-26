<?php

namespace App\Http\Controllers;

//DB Callings
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use App\InventoryModel;
use App\Http\Requests;
use Validator;
use Session;


class AddPackageController extends Controller
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
        // $name = DB::table('inventory')
        // ->select('inventory_name')
        // ->get();

        // $rental_cost = DB::table('inventory')
        // ->select('rental_cost')
        // ->get();

        $inventory = DB::table('inventory')
        ->select('*')
        ->get();
        // dd($name);
        // dd($rental_cost);
        // return view('addpackages',['inventory_name' => $name, 'rental_cost' => $rental_cost]);
        return view('addpackages',[ 'Inventory' => $inventory]);
    }


    public function insert(Request $request)
    {

        if($request->ajax())
         
        {
          $rules = array(
           'name.*'  => 'required',
           'quantity.*'  => 'required',
           'rental_cost.*'  => 'required'
          );

          $error = Validator::make($request->all(), $rules);
          if($error->fails())
          {
           return response()->json([
            'error'  => $error->errors()->all(),
           ]);
          }
    
          $name = $request->name;
          $quantity = $request->quantity;
          //$rental_cost = $request->rental_cost;

          for($count = 0; $count < count($name); $count++)
          {
           $data = array(
            'name' => $name[$count],
            //'quantity'  => $quantity[$count],
            //'rental_cost' => $quantity[$count]
           );
           $insert_data[] = $data; 
           dd($data);

          }
    
        //   DB::insert($package_items);
        //   return response()->json([
        //    'success'  => 'Items Added successfully.'
        //   ]);
            
         
        //   $package = new package();
        //     $package->package_name = $request->input('package_name');
        //     $package->price = $request->input('rental_cost');
        //     $package->quantity = $request->input('quantity');

        //     // $inventory->sku = $faker->unique()->isbn13;
        //     // $inventory->date_created = Carbon::now();
        //     // $inventory->status = '1';
        //     // $inventory->itemSource = $request->input('source');
        //     // $inventory->color = $request->input('color');
        //     // $inventory->threshold = $request->input('threshold');
        //     // $inventory->price = $request->input('price');
        //     // $inventory->size = $request->input('size');
        //      $package->save();

    }
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
        // $package_items = DB::table('package')
        // // ->join('reserve_venue','event.reservation_id','=','reserve_venue.reservation_id')
        // ->join('package_misc_item', 'package.packages_id', '=', 'package_misc_item.id')
        // ->select('*')
        // //->where('event.status', '=', '5')
        // ->save();

        // return redirect('/summary', compact('client', 'packages', 'success'));
         
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
