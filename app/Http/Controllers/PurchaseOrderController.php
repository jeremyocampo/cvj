<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Mail\PurchaseOrderMail;
use Illuminate\Support\Facades\Mail;
>>>>>>> 428d0760ee547bb74a82f0c13ea4492de4ead3fe
use App\Http\Requests\PurchaseOrder\AddRequest;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['items'])->get();
        $suppliers = Supplier::select(['supplier_id', 'name'])->get();

        return view('orders.index', compact('purchaseOrders', 'suppliers'));
    }

    public function store(AddRequest $request)
    {
<<<<<<< HEAD
        dd($request->validated());

=======
>>>>>>> 428d0760ee547bb74a82f0c13ea4492de4ead3fe
        $purchaseOrder = new PurchaseOrder($request->validated());
        $purchaseOrder->supplier()->associate($request->supplier_id);
        $purchaseOrder->save();
        
        foreach($request->get('items', []) as $item) {
            $item = new PurchaseOrderItem([
<<<<<<< HEAD
                'item' => $item->item,
                'rate' => $item->rate,
                'quantity' => $item->quantity
=======
                'item' => $item['name'],
                'rate' => $item['rate'],
                'quantity' => $item['quantity'],
                'total' => $item['total']
>>>>>>> 428d0760ee547bb74a82f0c13ea4492de4ead3fe
            ]);

            $item->purchaseOrder()->associate($purchaseOrder);
            $item->save();
        }

        return response()->json($purchaseOrder);
    }
<<<<<<< HEAD
=======

    public function email(PurchaseOrder $order)
    {
        $supplier = $order->supplier()->first();
        $email = $supplier->contacts()->first()->email;

        if ($email === null) {
            return response()->json([
                'message' => 'Please Provide a proper email'
            ], 422);
        }

        Mail::to($email)->send(new PurchaseOrderMail($order));

        return response()->json([
            'message' => 'Email Sent'
        ]);
    }

    public function receive(PurchaseOrder $order)
    {
        $order->update([
            'status' => 'received'
        ]);
        $order->save();

        return response()->json([
            'message' => 'Success'
        ]);
    }
>>>>>>> 428d0760ee547bb74a82f0c13ea4492de4ead3fe
}
