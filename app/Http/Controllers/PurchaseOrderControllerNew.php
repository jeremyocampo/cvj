<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\events;
use App\PurchaseOrderNew;
use App\PurchaseOrderItemNew;
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

    public function store(Request $request)
    {
        
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
