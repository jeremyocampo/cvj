<?php

namespace App\Http\Controllers;

use App\Event;
use App\events;
use App\inventory;
use App\Items;
use App\PackageInventory;
use App\PackageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use Session;
use Illuminate\Support\Facades\Auth;
class SelectPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        $event = Event::where('event_id','=',$event_id)->first();
        $client_id = Auth::id();
        $packages = PackageModel::where('suggested_pax','>=',$event->totalpax)->get();
        error_log("looged_user: ".$client_id);
        foreach ($packages as $package){
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            }
            //$package->inventory = inventory::whereIn('inventory_id',$inv_items)->get();

        }
        return view('selectPackage',['packages'=>$packages,'event'=>$event,'user_id'=>$client_id]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $event = events::where('event_id','=',$request->input('event_id'))->first();
        $event->package_id = $request->input('package_id');
        $event->save();
        /*
        $appetizersSelected = array();
        //FOR APPETIZERS
        for ($i = 0; $i < 6; $i++){
            $tempName = "appetizer".$i;
            if ($request->input($tempName)!=null){
                array_push($appetizersSelected, $request->input($tempName));
            }
        }

        dd($appetizersSelected);

        // $client = null;
        // $packages = 
        
        $items = new PackageModel();
        $items->item_name = $request->$appetizersSelected[0];
        if($request->input('custom') != ""){
            $items->package_id = 2;
        }
        $items->rawmaterial_id = $request->input('quantity');

       
        //$inventory->last_modified = Carbon::now();
        $items->save();

        $success = "Packages Selected!";
        return redirect('/summary', compact('client', 'packages', 'success'));
        
        
        // return redirect('/summary')
        // ->with('success', "Packages Selected!")
        // ->with('client', $client)
        // ->with('packages', $packages);
*/
        return redirect('/home');
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
