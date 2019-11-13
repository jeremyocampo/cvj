<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDishes;
use App\EventInventory;
use App\EventModel;
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
        //$packages = PackageModel::where('suggested_pax','>=',$event->totalpax)->get();
        $packages = PackageModel::all();

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
        return view('selectPackage',['packages'=>$packages->reverse(),'event'=>$event,'user_id'=>$client_id]);
        
    }

    /**
     *
     *
     * CREATING CUSTOMIZED PACKAGE
     */
    public function store(Request $request)
    {
        //chosen_invs,inv_qty,chosen_dishes,
        // dd($request);
        $package = new PackageModel();

        $package->package_name = $request->input("package_name");
        $package->package_client_id = $request->input("client_id");
        $package->package_img_url = 'img/default.jpg';
        $package->suggested_pax = $request->input("suggested_pax");
        $package->price = $request->input("venue_price");
        $package->save();

        $event = EventModel::where('event_id','=',$request->input('event_id'))->first();

        error_log("event_selected: ".$event->event_id);
        error_log("saved: ".$package);
        error_log("saved: ".$package->package_id);

        for($i=0; $i<count($request->input("chosen_invs"));$i++){
            $package_inventory = new PackageInventory();
            $inv = inventory::where('inventory_id','=',$request->get("chosen_invs")[$i])->first();

            $package_inventory->package_id = $package->package_id;
            $package_inventory->inventory_id = $inv->inventory_id;
            $package_inventory->category_id = $inv->category;
            $package_inventory->rent_cost = $inv->rental_cost;
            $package_inventory->quantity = $request->get("inv_qty")[$i];

            $package_inventory->save();
            $package->price += $package_inventory->rent_cost * $package_inventory->quantity;

            $e_inv = new EventInventory();
            $e_inv->event_id = $request->input("event_id");
            $e_inv->inventory_id = $inv->inventory_id;
            $e_inv->qty = $request->get("inv_qty")[$i];
            $e_inv->rent_price = $inv->rental_cost;
            $e_inv->esku = $inv->inventory_id;
            $e_inv->status = $inv->status;
            $e_inv->is_addition = false;
            $e_inv->save();
        }
        for($i=0; $i<count($request->input("chosen_dishes"));$i++){
            $package_item = new PackageItem();
            $itn = Items::where('item_id','=',$request->get("chosen_dishes")[$i])->first();
            $package_item->package_id = $package->package_id;
            $package_item->item_id = $itn->item_id;
            $package_item->computed_cost = $itn->unit_cost * $package->suggested_pax;
            $package_item->save();
            $package->price += $package_item->computed_cost;

            $e_dsh = new EventDishes();
            $e_dsh->event_id = $request->input("event_id");
            $e_dsh->item_id = $itn->item_id;
            $e_dsh->total_price = $package_item->computed_cost;
            $e_dsh->is_addition = false;
            $e_dsh->save();
        }
        $package->save();
        error_log("event ID: ".$request->input('event_id'));
        $event->package_id = $package->package_id;
        $event->total_amount_due = $request->input('package_price');
        $event->save();

        return redirect('/summary/'.$event->event_id);
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
        $package = PackageModel::where('package_id','=',$event->package_id)->first();
        $event->total_amount_due = $package->price;
        $event->save();
        foreach (PackageInventory::where('package_id','=',$event->package_id)->get() as $inv){
            $e_inv = new EventInventory();
            $inv_inv = inventory::where('inventory_id','=',$inv->inventory_id);
            $e_inv->event_id = $event->event_id;
            $e_inv->inventory_id = $inv->inventory_id;
            $e_inv->qty = $inv->quantity;
            $e_inv->rent_price = $inv->rent_cost;
            $e_inv->esku = $inv_inv->sku;
            $e_inv->status = $inv_inv->status;
            $e_inv->is_addition = false;
            $e_inv->save();
        }
        foreach (PackageItem::where('package_id','=',$event->package_id)->get() as $itm){
            $e_dsh = new EventDishes();
            $e_dsh->event_id = $event->event_id;
            $e_dsh->item_id = $itm->item_id;
            $e_dsh->total_price = $itm->computed_cost;
            $e_dsh->is_addition = false;
            $e_dsh->save();
        }

        return redirect('/summary/'.$event->event_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($event_id, $package_id=null)
    {
        $package = null;
        $venue_cost_table = array("CVJ Clubhouse Ground Floor"=>15000,
                                  "CVJ Clubhouse Second Floor"=>20000,
                                  "CVJ Clubhouse Third Floor"=>22000
                                  );
        $event = events::where('event_id','=',$event_id)->first();
        $client_id = Auth::id();
        if($package_id != null){
            $package = PackageModel::where('package_id','=',$package_id)->first();
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            }
            $inv_items = PackageInventory::where('package_id','=',$package->package_id)->select('inventory_id')->get();
            $inv_items = $inv_items->toArray();

            $avail_foods = Items::whereNotIn('item_id',$food_items)->get();
            $avail_invs = inventory::whereNotIn('inventory_id',$inv_items)->get();
        }
        else{
            $avail_foods = Items::all();
            $avail_invs = inventory::all();
        }
        return view('customizePackage',['venue_price'=>($event->venue == null ? null:$venue_cost_table[$event->venue]),'user_id'=>$client_id,'package'=>$package,'event'=>$event,'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function summary($event_id)
    {
        //inventory items //food items
        $client_id = Auth::id();
        $event = Event::where('event_id','=',$event_id)->first();

        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("H:i", strtotime($event->event_start));
        $event->formatted_end = date("H:i", strtotime($event->event_end));

        $package = PackageModel::where('package_id','>=',$event->package_id)->first();
        $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
        $food_items =$food_items->toArray();
        $package->foods = Items::whereIn('item_id',$food_items)->get();
        $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        foreach ($event_inventories as $inventory){
            $event_inventories->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        return view('bookingsummary',['package'=>$package,'event'=>$event,'user_id'=>$client_id,'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes,'additional_invs'=>$event_inventories]);
    }
    public function test_page1($event_id, $package_id=null)
    {
        $package = null;
        $venue_cost_table = array("CVJ Clubhouse Ground Floor"=>15000,
            "CVJ Clubhouse Second Floor"=>20000,
            "CVJ Clubhouse Third Floor"=>22000
        );
        $event = events::where('event_id','=',$event_id)->first();
        $client_id = Auth::id();
        if($package_id != null){
            $package = PackageModel::where('package_id','=',$package_id)->first();
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            }

            $avail_foods = Items::whereNotIn('item_id',$food_items)->get();
        }
        else{
            $avail_foods = Items::all();
        }
        $avail_invs = inventory::all();

        return view('prototype_views/customizePackageTest',['venue_price'=>($event->venue == null ? null:$venue_cost_table[$event->venue]),'user_id'=>$client_id,'package'=>$package,'event'=>$event,'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs]);
    }
    public function additional_package($event_id, $package_id=null)
    {
        $package = null;
        $venue_cost_table = array("CVJ Clubhouse Ground Floor"=>15000,
            "CVJ Clubhouse Second Floor"=>20000,
            "CVJ Clubhouse Third Floor"=>22000
        );
        $event = events::where('event_id','=',$event_id)->first();
        $client_id = Auth::id();
        if($package_id != null){
            $package = PackageModel::where('package_id','=',$package_id)->first();
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            }

            $avail_foods = Items::whereNotIn('item_id',$food_items)->get();
        }
        else{
            $avail_foods = Items::all();
        }
        $avail_invs = inventory::all();

        return view('additionalPackage',['venue_price'=>($event->venue == null ? null:$venue_cost_table[$event->venue]),'user_id'=>$client_id,'package'=>$package,'event'=>$event,'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs]);

    }
    public function create_with_additions(Request $request)
    {
        //chosen_invs,inv_qty,chosen_dishes
        $event = events::where('event_id','=',$request->input('event_id'))->first();
        $event->package_id = $request->input('package_id');
        $event->save();
        $package = PackageModel::where('package_id','=',$request->input('package_id'))->first();
        $tot = 0;
        // load selected package contents to event ref tables
        foreach (PackageInventory::where('package_id','=',$event->package_id)->get() as $inv){
            $e_inv = new EventInventory();
            $inv_inv = inventory::where('inventory_id','=',$inv->inventory_id)->first();
            $e_inv->event_id = $event->event_id;
            $e_inv->inventory_id = $inv->inventory_id;
            $e_inv->qty = $inv->quantity;
            $e_inv->rent_price = $inv->rent_cost;

            //$tot += $e_inv->qty * $e_inv->rent_price;

            $e_inv->esku = $inv_inv->sku;
            $e_inv->status = $inv_inv->status;
            $e_inv->is_addition = false;
            $e_inv->save();
        }
        foreach (PackageItem::where('package_id','=',$event->package_id)->get() as $itm){
            $e_dsh = new EventDishes();
            $e_dsh->event_id = $event->event_id;
            $e_dsh->item_id = $itm->item_id;
            $e_dsh->total_price = $itm->computed_cost;
            //$tot += $e_dsh->total_price;
            $e_dsh->is_addition = false;
            $e_dsh->save();
        }
        // load additionals to event ref tables
        for($i=0; $i<count($request->input("chosen_invs"));$i++){
            $inv = inventory::where('inventory_id','=',$request->get("chosen_invs")[$i])->first();
            $e_inv = new EventInventory();

            $e_inv->event_id = $event->event_id;
            $e_inv->inventory_id = $inv->inventory_id;
            $e_inv->qty = $request->get("inv_qty")[$i];
            $e_inv->rent_price = $inv->rental_cost;
            $e_inv->esku = $inv->sku;
            $e_inv->status = $inv->status;
            $e_inv->is_addition = true;
            $e_inv->save();

            $tot += $e_inv->qty * $e_inv->rent_price;
        }
        for($i=0; $i<count($request->input("chosen_dishes"));$i++){
            $itn = Items::where('item_id','=',$request->get("chosen_dishes")[$i])->first();
            $e_dsh = new EventDishes();

            $e_dsh->event_id = $request->input("event_id");
            $e_dsh->item_id = $itn->item_id;
            $e_dsh->total_price = $itn->unit_cost * $package->suggested_pax;
            $e_dsh->is_addition = true;
            $e_dsh->save();

            $tot += $e_dsh->total_price;
        }
        $tot += $package->price;
        $event->total_amount_due = $tot;
        $event->save();

        return redirect('/summary/'.$event->event_id);
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
