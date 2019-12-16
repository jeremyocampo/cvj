<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;

class InventoryHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $joinedTable = DB::table('category_ref')
        // ->join('category_ref','inventory.category','=','category_ref.id')
        ->join('inventory','category_ref.category_no','=','inventory.category')
        ->get();

        return view('inventoryDashboard',['joinedTable' => $joinedTable, ]);
    }
}
