<?php

namespace App\Http\Controllers;

use App\Event;
use App\events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\userModel;
// use public;

class FileController extends Controller
{
    public function download($file_name) {
        $file_path = storage_path("app/uploads/".$file_name);
        return response()->download($file_path);
    }

    public function upload_event_forms(Request $request)
    {
        $event = events::where('event_id','=',$request->input('event_id'))->first();

        if($request->fileToUpload_reservation != null){
            $fileName = time()."_res.".$request->fileToUpload_reservation->getClientOriginalExtension();
            error_log("reserve name: ".$fileName);
            $event->reservation_file_path = storage_path('app/uploads/'.$fileName);
            $event->save();

            $request->fileToUpload_reservation->storeAs('uploads',$fileName);
        }
        if($request->fileToUpload_deposit != null){
            $fileName = time()."_dep.".$request->fileToUpload_deposit->getClientOriginalExtension();
            error_log("deposit name: ".$fileName);
            $event->deposit_file_path = storage_path('app/uploads/'.$fileName);
            $event->save();

            $request->fileToUpload_deposit->storeAs('uploads',$fileName);
        }
        return redirect('list_events');
    }
    public function mail()
    {
        $mail = 'Oh hello this is you and i am you. He. He.';
        Mail::to('jeremy_ocampojr@dlsu.edu.ph')->send(new SendMailable($mail));
        
        return redirect('/home')->with('success', 'Your account and booking has been successfully created. Please check your email.');
    }
}
