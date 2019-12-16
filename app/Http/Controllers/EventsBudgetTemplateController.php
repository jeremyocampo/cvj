<?php

namespace App\Http\Controllers;

use App\EventBudget;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\inventory;
use App\categoryRef;
use App\OutsourcedItem;
use App\EventBudgetTemplate;
use App\EventBudgetTemplateItem;
use App\Package;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;

class EventsBudgetTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget_templates = EventBudgetTemplate::All();
        foreach($budget_templates as $budget_template){
            $budget_template->event_budget_template_item =
                EventBudgetTemplateItem::where("event_budget_template_id","=",$budget_template->id)->get();
        }
        return view('eventBudgetTemplates',
            ['budget_templates' => $budget_templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_budget_template = new EventBudgetTemplate();
        $event_budget_template->template_name = $request->input('template_name');
        $event_budget_template->save();
        for($i=0; $i<count($request->input("item_name"));$i++){
            $event_budget_template_item = new EventBudgetTemplateItem();
            $event_budget_template_item->event_budget_template_id = $event_budget_template->id;
            $event_budget_template_item->item_name = $request->get("item_name")[$i];
            $event_budget_template_item->default_value = $request->get("default_value")[$i];
            $event_budget_template_item->save();
        }
        redirect('event_budget_template');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public static function getOutsourceItem_by_Id($id){
        return $outsource_item = DB::table('outsourced_item')->where('outsourced_item_id', '=',$id)->first();
    }
    public static function getSupplier_by_Id($id){
       return $supplier = Supplier::where('supplier_id', '=',$id)->first();
    }

    public static function getPackage_by_Id($id){
        return $supplier = Package::where('package_id', '=',$id)->first();
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


    }
        //

}
