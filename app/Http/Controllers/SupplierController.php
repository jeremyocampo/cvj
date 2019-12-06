<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\ContactPerson;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\AddRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\SupplierItem;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::select(['supplier_id', 'name', 'is_enabled', 'created_at'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('supplier.index', compact('suppliers'));
    }

    public function store(AddRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return response()->json($supplier);
    }

    public function show(Supplier $supplier)
    {
        $supplier = Supplier::with(['contacts', 'items'])->where('supplier_id', $supplier->supplier_id)->first();

        return response()->json($supplier->toArray());
    }

    public function update(Supplier $supplier, UpdateRequest $request)
    {
        $supplier->update($request->validated());

        return response()->json($supplier);
    }

    public function state(Supplier $supplier, Request $request)
    {
        $supplier->update([
            'is_enabled' => $request->enable === "true" ? true : false
        ]);
        
        return response()->json($supplier);
    }

    public function addContact($supplier, Request $request)
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();

        $contactPerson = new ContactPerson([
            'name' => $request->name,
            'fax' => $request->fax,
            'landline' => $request->landline,
            'mobile' => $request->mobile,
            'email' => $request->email
        ]);
        $contactPerson->supplier()->associate($supplier);
        $contactPerson->save();

        return response()->json($contactPerson);
    }

    public function addItem($supplier, Request $request)
    {
        $supplier = Supplier::where('supplier_id', $supplier)->first();

        $item = new SupplierItem([
            'item' => $request->item,
            'rate' => $request->rate,
        ]);
        $item->supplier()->associate($supplier);
        $item->save();

        return response()->json($item);
    }
}
