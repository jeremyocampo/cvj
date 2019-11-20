<?php
namespace App\Http\Controllers;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\UpdateRequest;
class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::select(['supplier_id', 'name', 'is_enabled'])->get();
        return view('supplier.index', compact('suppliers'));
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
}