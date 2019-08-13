<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\EventModel;
use App\Package;
use App\EventBudget;
use App\EventBudgetItem;

class DateRangeController extends Controller
{
    function index()
    {
        $event = DB::table('event')
        ->join('package','event.package_id','=','package.package_id')
        ->join('event_budget', 'event.event_id', '=', 'event_budget.id')
        ->select('*')
        ->where('event.status', '=', '5')
        ->get();

        return view('date_range',['event' => $event]);
     


    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      if($request->from_date != '' && $request->to_date != '')
      {
       $data = DB::table('event')
         ->whereBetween('event_start', array($request->from_date, $request->to_date))
         ->get();
      }
      else
      {
       $data = DB::table('event')->orderBy('event_start', 'desc')->get();
      }
      echo json_encode($data);
     }
    }
}

?>