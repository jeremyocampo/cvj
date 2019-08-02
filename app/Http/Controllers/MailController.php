<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\inventory;
use App\categoryRef;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Mail;
class MailController extends Controller
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

        $to_name = 'Anigav Sinep';
        $to_email = 'jeremy_ocampojr@dlsu.edu.ph';
        $data = array('send_mail'=>'monkaS', 'body' => 'monkey');
        Mail::send('send_mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Caterie Email');
            $message->from('betbot.py@gmail.com','Caterie Bot');
        });

        return redirect("home");
        
    }
    public function send_email($send_name, $send_email, $subject){
        $to_name = $send_name;
        $to_email = $send_email;
        $data = array('send_mail'=>'monkaS', 'body' => 'monkey','client_name','event_name',);
        Mail::send('send_mail', $data, function($message) use ($to_name, $to_email, $subject) {
            $message->to($to_email, $to_name)->subject($subject);
            $message->from('betbot.py@gmail.com','Caterie Bot');
        });
        error_log('Some message here.');
        error_log('Some message here.');
        error_log('Some message here.');

        return "sent_";
    }
}
