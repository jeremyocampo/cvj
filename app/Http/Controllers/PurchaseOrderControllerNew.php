<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\events;
use App\inventory;
use App\PurchaseOrderNew;
use App\PurchaseOrderItemNew;
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
            
            if($event->quantity_created == 0){
                $event->status = "No Purchase Orders Created";
                $event->status_color = "orange";
            }
            elseif($event->quantity_created == $event->quantity_required){
                $event->all_created = 1;
                $event->status = "All Purchase Order Request Created";
                $event->status_color = "green";
            }
            else{
                $event->status = "Purchase Orders Partially Created";
                $event->status_color = "blue";
            }
        }
        $purchaseOrders = PurchaseOrderNew::all();
        foreach($purchaseOrders as $po){
            //code for setting PO's fulfilled
            $po->all_fulfilled = 0;
        }
        
        $suppliers = Supplier::select(['supplier_id', 'name'])->get();
        
        //make a filtered object for tracking returns items
        return view('purchase_orders.index', ['purchaseOrders' => $purchaseOrders, 'suppliers' => $suppliers,'outsource_events'=>$event_with_outsource]);
    }
    public function get_add_po($event_id)
    {
        $po_obj = new PurchaseOrderNew();
        $event = events::where('event_id','=',$event_id)->first();
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
        //$po_obj->created_at = Carbon::now();
        $po_obj->shipment_preferences =  $request->input("shipmentPreference");
        $po_obj->save();
        
        
        
        for($i=0; $i<count($request->input("inv_ids"));$i++){
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
        
        return redirect('/purchase-order-list/');
    }
    public function receive($purchase_order_id)
    {
        $order = PurchaseOrderNew::where("purchase_order_id",'=',$purchase_order_id)->first();
        $order->update([
            'status' => 'received'
        ]);
        $order->save();

        return response()->json([
            'message' => 'Success'
        ]);
    }
}
