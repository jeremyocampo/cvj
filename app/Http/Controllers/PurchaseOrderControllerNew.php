<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\events;
use App\inventory;
use App\PurchaseOrderNew;
use App\PurchaseOrderItemNew;
use App\PurchaseOrderItemAdd;
use Carbon\Carbon;
use App\EventOutsourceInventory;
use Illuminate\Http\Request;
use App\Mail\PurchaseOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PurchaseOrder\AddRequest;

use Illuminate\Support\Facades\Log;
class PurchaseOrderControllerNew extends Controller
{
    public function index()
    {
        $event_obj = new events();
        error_log("disp: "."69");
        $event_with_outsource = $event_obj->events_with_outsource();
        foreach($event_with_outsource as $event){
            $event->all_created = 0;
            $event->quantity_created = $event->outsource_quantity_created();
            $event->quantity_required = $event->outsource_quantity_required();
            
            if($event->all_po_created()){
                $event->all_created = 1;
                $event->status = "All Purchase Order Created";
                $event->status_color = "green";
            }else{
                if($event->quantity_created == 0){
                    $event->status = "No Purchase Orders Created";
                    $event->status_color = "orange";
                }else{      
                    $event->all_created = 2;
                    $event->status = "Purchase Orders Partially Created";
                    $event->status_color = "blue";
                }
            } 
        }
        $purchaseOrders = PurchaseOrderNew::all();
        foreach($purchaseOrders as $po){
            //code for setting PO's fulfilled
            //0 none received, 1, partial received, 2 all received
            $po->receive_status = $po->receive_status();
            $po->receive_status_text = $po->receive_status_text($po->receive_status);
            $po->quantity_required = $po->totalQuantity();
            $po->quantity_received = $po->total_items_received();
        }
        
        $suppliers = Supplier::select(['supplier_id', 'name'])->get();
        
        //make a filtered object for tracking returns items
        return view('purchase_orders.index', ['purchaseOrders' => $purchaseOrders, 'suppliers' => $suppliers,'outsource_events'=>$event_with_outsource]);
    }
    public function get_add_po($event_id)
    {
        $po_obj = new PurchaseOrderNew();
        $event = events::where('event_id','=',$event_id)->first();
     
        $newdate = strtotime ( '-3 day' , strtotime ( $event->event_start ) ) ;
        $newdate = date ( 'Y-m-j' , $newdate );

        error_log("orig. date is: ". $event->event_start);
        error_log("new date is: ".$newdate);
        $max_val_date = $newdate;

        $outsource_inventory = EventOutsourceInventory::where('event_id','=',$event_id)->get();
        $existing_pos = PurchaseOrderNew::where('event_id','=',$event_id)->get();
        foreach($outsource_inventory as $inv){
            $inventory_obj = $inv->inventory();
            $inv->inventory_name = $inventory_obj->inventory_name;
            $inv->qty_created = (is_null($inv->get_quantity_created()) ?  0 : $inv->get_quantity_created());
            
        }
        $suppliers = Supplier::select(['supplier_id', 'name'])->get();
        return view('purchase_orders.add_po', ['event' => $event,'suppliers' => $suppliers, 
        'outsource_inventory' => $outsource_inventory,
        'temp_reference_num' => ($po_obj->temp_reference_number() + 10000),
        'max_val_date'=>$max_val_date,
        'existing_pos' => $existing_pos]);
    }
    public function event_po_detail($event_id)
    {
        $po_obj = new PurchaseOrderNew();
        $event = events::where('event_id','=',$event_id)->first();
       
        $event->quantity_required = $event->outsource_quantity_required();
        $event->total_amount = 0;
            
        $newdate = strtotime ('+0 day', strtotime($event->event_start)) ;
        $newdate = date ( 'Y-m-j' , $newdate );

        $outsource_inventory = EventOutsourceInventory::where('event_id','=',$event_id)->get();
        $existing_pos = PurchaseOrderNew::where('event_id','=',$event_id)->get();

        foreach($outsource_inventory as $inv){
            $inventory_obj = $inv->inventory();
            $inv->inventory_name = $inventory_obj->inventory_name;
            $inv->qty_created = (is_null($inv->get_quantity_created()) ?  0 : $inv->get_quantity_created());
        }
        foreach($existing_pos as $po){
            $po->supplier_name = $po->supplier()->name;
            $po->po_items = $po->items();
            $po->total = $po->total();
            $po->all_received = 0; //towrite all function give me sight.
            $po->expected_delivery_date = date ( 'Y-m-j' , strtotime('+0 day', strtotime($po->expected_delivery_date)));
            $po->created_at = $po->created_at;
            $event->total_amount += $po->total;
            //error_log('edd: '.$po->expected_delivery_date);
            //error_log('ca: '.$po->created_at);
        }
        return view('purchase_orders.event_po_detail', ['event' => $event,
        'outsource_inventory' => $outsource_inventory,
        'temp_reference_num' => ($po_obj->temp_reference_number() + 10000),
        'event_start_date'=>$newdate,
        'existing_pos' => $existing_pos]);
    }
    public function store(Request $request)
    {
        $po_obj = new PurchaseOrderNew();
        $po_obj->reference_number =  $request->input("reference_number");
        $po_obj->event_id =  $request->input("event_id");
        $po_obj->supplier_id =  $request->input("supplier");
        $po_obj->billing_address =  $request->input("delivery_address");
        $po_obj->expected_delivery_date =  $request->input("expectedDelDate");
        $po_obj->status = 'Pending';
        $po_obj->created_at = Carbon::now();
        $po_obj->shipment_preferences =  $request->input("shipmentPreference");
        $po_obj->save();
        
        
        
        for($i=0; $i<count($request->input("inv_ids"));$i++){
            if($request->get("itemQuantity")[$i] != 0){ 
                $po_item = new PurchaseOrderItemNew();

                $inv = inventory::where('inventory_id','=',$request->get("inv_ids")[$i])->first();
                $po_item->purchase_order_id = $po_obj->purchase_order_id;
                $po_item->inventory_id = $request->get("inv_ids")[$i];
                
                $po_item->name = $inv->inventory_name;
                $po_item->inventory_name = $po_item->name;
                
                $po_item->rate =  $request->get("itemRate")[$i];
                $po_item->quantity = $request->get("itemQuantity")[$i];
                
                $po_item->created_at = Carbon::now();
                $po_item->save();
            }
        }
        
        return redirect('/purchase-order-list/');
    }
    public function get_receive($po_id)
    {
        $po_obj = PurchaseOrderNew::where('purchase_order_id','=',$po_id)->first();
        $event = events::where('event_id','=',$po_obj->event_id)->first();
     
        $po_obj->expected_delivery_date = strtotime ( '+0 day' , strtotime ( $po_obj->expected_delivery_date ) ) ;
        $po_obj->expected_delivery_date = date ( 'Y-m-j' , $po_obj->expected_delivery_date );

        
        $po_items = PurchaseOrderItemNew::where('purchase_order_id','=',$po_id)->get();
        foreach($po_items as $po_item){
            $po_item->qty_received = (is_null($po_item->total_items_received()) ?  0 : $po_item->total_items_received());
        }
        return view('purchase_orders.receive_po', ['event' => $event,
        'po'=>$po_obj,
        'po_items' => $po_items]);
    }
    public function receive(Request $request)
    {
        for($i=0; $i<count($request->input("po_item_ids"));$i++){
            if($request->get("itemQuantity")[$i] != 0){ 
                $po_item_add = new PurchaseOrderItemAdd();

                $po_item_add->po_item_id = $request->input("po_item_ids")[$i];
                $po_item_add->quantity = $request->get("itemQuantity")[$i];
                
                $po_item_add->date_fulfilled = Carbon::now();
                $po_item_add->created_at = Carbon::now();
                $po_item_add->save();
            }
        }
        return redirect('/purchase-order-list/');
    }
}
