<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use Session;

use PDF;
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
        $packages = PackageModel::where('event_type','=',$event->event_type)->where('suggested_pax','<=',$event->totalpax)->get();
        //$packages = PackageModel::all();

        error_log("looged_user: ".$client_id);
        foreach ($packages as $package){
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inv = inventory::where('inventory_id','=',$inventory->inventory_id)->first();
                $inventory->inventory_name = $inv->inventory_name;
                $inventory->inv_avail =$inventory->is_inventory_available();
                $inventory->inv_cat = $inv->category()->category_name;

                error_log("package_id_nm: ".$package->package_id.$package->package_name);
                error_log($inventory->inventory_name.": ".$inventory->is_inventory_available());
                error_log("p_inv_qty: ".$inventory->quantity);
                error_log("inv_qty ".$inv->quantity);

            }
            //$package->inventory = inventory::whereIn('inventory_id',$inv_items)->get();
        }
        return view('selectPackage',['packages'=>$packages->reverse(),'event'=>$event,'user_id'=>$client_id]);
    }
    public function list_packages()
    {
        $packages = PackageModel::all();
        foreach ($packages as $package){
            $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inv = inventory::where('inventory_id','=',$inventory->inventory_id)->first();
                $inventory->inventory_name = $inv->inventory_name;
                $inventory->inv_avail =$inventory->is_inventory_available();
            }
            //$package->inventory = inventory::whereIn('inventory_id',$inv_items)->get();
        }
        $user = User::where('id','=',Auth::id())->first();
        return view('list_packages',['user'=>$user,'packages'=>$packages->reverse()]);

    }
    public function edit_package(Request $request)
    {
        $package = PackageModel::where('package_id','=',$request->package_id)->first();
        $package->reset_package_contents();

        $event = events::where('event_id','=',$request->input('event_id'))->first();
        $package->package_name = $request->input("package_name");
        $package->package_client_id = $request->input("client_id");
        $package->package_img_url = 'img/default.jpg';
        $package->suggested_pax = $request->input("suggested_pax");
        $package->price = $request->input("package_price");
        $package->event_type = $request->input("eventType");

        $package->package_markup = $request->input("package_markup");
        $package->package_desc = $request->input("package_desc");
        $package->save();

        error_log("edit_saved: ".$package);

        for($i=0; $i<count($request->input("chosen_invs"));$i++){
            $package_inventory = new PackageInventory();
            $inv = inventory::where('inventory_id','=',$request->get("chosen_invs")[$i])->first();

            $package_inventory->package_id = $package->package_id;
            $package_inventory->inventory_id = $inv->inventory_id;
            $package_inventory->category_id = $inv->category;
            $package_inventory->rent_cost = $inv->rental_cost;
            $package_inventory->quantity = $request->get("inv_qty")[$i];

            $package_inventory->save();
        }
        for($i=0; $i<count($request->input("chosen_dishes"));$i++){
            $package_item = new PackageItem();
            $itn = Items::where('item_id','=',$request->get("chosen_dishes")[$i])->first();
            $package_item->package_id = $package->package_id;
            $package_item->item_id = $itn->item_id;
            $package_item->computed_cost = $itn->unit_cost * $package->suggested_pax;

            $package_item->save();
        }

        $package->save();
    }
    /**
     *
     *
     * CREATE NEW PACKAGE
     */
    public function create(Request $request)
    {
        //chosen_invs,inv_qty,chosen_dishes,
        // dd($request);
        if($request->input("package_id") == -1){
            error_log("creating new package");
            $package = new PackageModel();

            $package->package_name = $request->input("package_name");
            $package->package_client_id = $request->input("client_id");
            $package->package_img_url = 'img/default.jpg';
            $package->suggested_pax = $request->input("suggested_pax");
            $package->price = $request->input("package_price");
            $package->event_type = $request->input("eventType");

            $package->package_markup = $request->input("package_markup");
            $package->package_desc = $request->input("package_desc");
            $package->save();


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
                //$package->price += $package_inventory->rent_cost * $package_inventory->quantity;
                /*
                $e_inv = new EventInventory();
                $e_inv->event_id = $request->input("event_id");
                $e_inv->inventory_id = $inv->inventory_id;
                $e_inv->qty = $request->get("inv_qty")[$i];
                $e_inv->rent_price = $inv->rental_cost;
                $e_inv->esku = $inv->inventory_id;
                $e_inv->status = $inv->status;
                $e_inv->is_addition = false;
                $e_inv->save();
                */
            }
            for($i=0; $i<count($request->input("chosen_dishes"));$i++){
                $package_item = new PackageItem();
                $itn = Items::where('item_id','=',$request->get("chosen_dishes")[$i])->first();
                $package_item->package_id = $package->package_id;
                $package_item->item_id = $itn->item_id;
                $package_item->computed_cost = $itn->unit_cost * $package->suggested_pax;
                $package_item->save();
                //$package->price += $package_item->computed_cost;
                /*
                $e_dsh = new EventDishes();
                $e_dsh->event_id = $request->input("event_id");
                $e_dsh->item_id = $itn->item_id;
                $e_dsh->total_price = $package_item->computed_cost;
                $e_dsh->is_addition = false;
                $e_dsh->save();
                */
            }
            $package->save();
        }else{
            error_log("editing package");
            self::edit_package($request);
        }


        return redirect('/list_packages/');
    }
    /**
     *
     *
     * SELECT PACKAGE
     */
    public function select(Request $request)
    {
        $event = events::where('event_id','=',$request->input('event_id'))->first();
        $event->package_id = $request->input('package_id');
        $package = PackageModel::where('package_id','=',$event->package_id)->first();
        $event->total_amount_due = $package->price;

        if($event->venue == 'Off-Premise'){
            $event->off_premise_amount = $event->total_amount_due * 0.15;
            $event->total_amount_due = $event->total_amount_due * 1.15;
        }

        $event->costing_method = null;
        $event->save();
        foreach (PackageInventory::where('package_id','=',$event->package_id)->get() as $inv){
            $e_inv = new EventInventory();
            $inv_inv = inventory::where('inventory_id','=',$inv->inventory_id)->first();
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
        $event->set_default_cost_amount();
        $event->generate_avail_costing_models();
        $this->generate_quotation($event->event_id);
        return redirect('/summary/'.$event->event_id);
    }
    /**
     *
     *
     * SELECT PACKAGE with Additions
     */
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
        if($event->venue == 'Off-Premise'){
            $event->off_premise_amount = $event->total_amount_due * 0.15;
            $event->total_amount_due = $event->total_amount_due * 1.15;
        }

        $event->costing_method = null;
        $event->save();
        $event->set_default_cost_amount();
        $event->generate_avail_costing_models();
        $this->generate_quotation($event->event_id);

        return redirect('/summary/'.$event->event_id);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $package_id=null)
    {
        $package = null;
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
        foreach($avail_invs as $inv){
            $inv->cat_name = $inv->category()->category_name;
        }

        return view('customizePackage',['user_id'=>$client_id,'package'=>$package,'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs]);
    }

    /**post
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

        $package = PackageModel::where('package_id','=',$event->package_id)->first();
        $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
        $food_items =$food_items->toArray();
        $package->foods = Items::whereIn('item_id',$food_items)->get();
        $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        $employees_id = EmployeeEventSchedule::where("event_id",'=',$event_id)->get();
        $total_staff_cost = 0;

        foreach($employees_id as $employee_id){
            $emp = Employee::where('employee_id','=',$employee_id)->first();
            $total_staff_cost += 800; //dummy calculation of wages per day or gig.
        }


        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;

        }
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        return view('bookingsummary',
            ['package'=>$package,'event'=>$event,'user_id'=>$client_id,
             'additional_count'=>$additional_count,'additional_dishes'=>$event_dishes,
             'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost]);
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
    public function export_quotation_pdf($data,$event_id)
    {
        $event = events::where('event_id','=',$event_id)->first();
        // Fetch all customers from database
        //$data = Customer::get();
        // Send data to the view using loadView function of PDF facade

        $pdf = PDF::loadView('samp', $data);
        $fileName = time()."_cliQuot_autogen.pdf";

        error_log("idyota: ".$fileName);
        $event->save_client_quotation('/storage/public/'.$fileName);
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path().'/app/uploads/'.$fileName);


        //  $request->fileToUpload_deposit->storeAs('uploads',$fileName);
        // Finally, you can download the file using download function
        return redirect('list_events');
    }
    public function generate_quotation($event_id){
        $event = Event::where('event_id','=',$event_id)->first();
        $client = Client::where('client_id','=',$event->client_id)->first();

        $is_off_premise = $event->venue == "Off-Premise";
        $event->formatted_day = date("M jS, Y", strtotime($event->event_start));
        $event->formatted_start = date("g:i A", strtotime($event->event_start));
        $event->formatted_end = date("g:i A", strtotime($event->event_end));

        $package = PackageModel::where('package_id','>=',$event->package_id)->first();
        $food_items =PackageItem::where('package_id','=',$package->package_id)->select('item_id')->get();
        $food_items =$food_items->toArray();
        $package->foods = Items::whereIn('item_id',$food_items)->get();
        $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $additional_count = $event_inventories->count() + $event_dishes->count();

        $employees_id = EmployeeEventSchedule::where("event_id",'=',$event_id)->get();
        $total_staff_cost = 0;

        foreach($employees_id as $employee_id){
            $emp = Employee::where('employee_id','=',$employee_id)->first();
            $total_staff_cost += 800; //dummy calculation of wages per day or gig.
        }
        $add_inv_total = 0;
        foreach ($event_inventories as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            $add_inv_total += $inventory->qty * $inventory->rent_price;
        }
        $add_dish_total = 0;
        foreach ($event_dishes as $dish){
            $dish->item_name = Items::where('item_id','=',$dish->item_id)->first()->item_name;
            $add_dish_total += $dish->total_price;
        }

        foreach ($package->inventory as $inventory){
            $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
        }
        error_log("dish: ".$add_dish_total);
        error_log("inv: ".$add_inv_total);

        $this->export_quotation_pdf(['package'=>$package,'event'=>$event,'client'=>$client,
            'additional_count'=>$additional_count,'add_dish_total'=>$add_dish_total,'add_inv_total'=>$add_inv_total,
            'additional_dishes'=>$event_dishes, 'is_off_premise'=>$is_off_premise,
            'additional_invs'=>$event_inventories,'staff_count'=>count($employees_id),'staff_cost'=>$total_staff_cost],$event_id);

    }

    public function additional_package($event_id, $package_id=null)
    {
        $package = null;
        $venue_cost_table = array("CVJ Clubhouse Ground Floor"=>15000,
            "CVJ Clubhouse Second Floor"=>20000,
            "CVJ Clubhouse Third Floor"=>22000,
            "Off-Premise"=>null
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

        foreach($avail_invs as $inv){
            $inv->cat_name = $inv->category()->category_name;
        }

        return view('additionalPackage',['venue_price'=>$venue_cost_table[$event->venue],'user_id'=>$client_id,'package'=>$package,'event'=>$event,'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs]);

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
    public function edit_event_package($event_id)
    {
        $event = events::where('event_id','=',$event_id)->first();
        $package = $event->package();

        $package_id = $package->package_id;
        $event = events::where('event_id','=',$event_id)->first();

        $event_inventories = EventInventory::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();
        $event_dishes = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->get();

        $event_dishes_id = EventDishes::where('event_id','=',$event->event_id)->where('is_addition','=',true)->select('item_id')->get();

        $client_id = Auth::id();
        if($package_id != null){
            $food_items =EventDishes::where('event_id','=',$event_id)->where('is_addition','=',false)->select('item_id')->get();
            $food_items =$food_items->toArray();
            $package->foods = Items::whereIn('item_id',$food_items)->get();
            $package->inventory = PackageInventory::where('package_id','=',$package->package_id)->get();
            foreach ($package->inventory as $inventory){
                $inventory->inventory_name = inventory::where('inventory_id','=',$inventory->inventory_id)->first()->inventory_name;
            }
            $avail_foods = Items::whereNotIn('item_id',$food_items)->whereNotIn('item_id',$event_dishes_id)->get();
        }
        else{
            $avail_foods = Items::all();
        }
        $avail_invs = inventory::all();

        foreach($avail_invs as $inv){
            $inv->cat_name = $inv->category()->category_name;
        }

        foreach($event_inventories as $inv){
            $inv->inventory_name = $inv->inventory()->inventory_name;
        }
        foreach($event_dishes as $dish){
            $item = $dish->get_item();
            $dish->item_name = $item->item_name;
            $dish->item_image = $item->item_image;
            $dish->unit_cost = $item->unit_cost;

            error_log("awit??: ".$dish);
        }

        return view('editselectedPackage',['user_id'=>$client_id,'package'=>$package,'event'=>$event,
            'avail_foods'=>$avail_foods,'avail_invs'=>$avail_invs,
            'add_invs'=>$event_inventories,'add_dishes'=>$event_dishes]);

        //
    }
    public function post_edit_event_package(Request $request)
    {
        //chosen_invs,inv_qty,chosen_dishes
        $event = events::where('event_id','=',$request->input('event_id'))->first();
        //$event->save();
        $package = PackageModel::where('package_id','=',$request->input('package_id'))->first();
        $package->reset_package_additions($request->input('event_id'));

        $tot = 0;
        // load selected package contents to event ref tables
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
        if($event->venue == 'Off-Premise'){
            $event->off_premise_amount = $event->total_amount_due * 0.15;
            $event->total_amount_due = $event->total_amount_due * 1.15;
        }
        $event->costing_method = null;
        $event->save();

        $this->generate_quotation($event->event_id);
        $event->set_default_cost_amount();
        $event->generate_avail_costing_models();
        // When to renew quotation.
        return redirect('/summary/'.$event->event_id);

        //return redirect('list_events');
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {
        $event = events::where('event_id','=',$event_id)->first();
        $event->discard_package();
        $event->save();
        return redirect('list_events');
    }
}
