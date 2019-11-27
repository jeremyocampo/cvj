<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        //
        $client = DB::table('client')
        ->select('*')
        ->get();
        return view('clientList', ['clients' => $client]);
    }

    public function create()
    {
        //
        return view('createCLient');
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'client_name' => 'required',
            'email' => 'required|email|unique',
            'tel_no' => 'required|min:7|max:7',
            'mob_no' => 'required|min:10|max:11',
            'address' => 'required'
        ],
        [
            'client_name.required' => 'Client First Name is required.',
            'email.required' => 'Please Input a valid Email',
            'email.email' => 'Email is not valid',
            'email.required' => 'Email already exists',
            'tel_no.required' => 'Telephone is required.',
            'mob_no.required' => 'Please Input a valid Mobile Number ex.091223456789.',
            'address.required' => 'Please Input a valid Address.'
        ]);
        
        $client = new ClientAccountModel([
            'client_name' => $request->input('client_name'),
            'email' => $request->input('clientEmail'),
            'tel_no' => $request->input('telNo'),
            'mob_no' => $request->input('mobileNo'),
            'address' => $request->input('clientAddress'),
        ]);
        $client->save();
    }

    public function show($id)
    {
        //
        $client = DB::table('client')
        ->select('*')
        ->where('client_id', '=', $id)
        ->first();

        $dateCreated = DB::table('client')
        ->select('created_at')
        ->where('client_id', '=', $id)
        ->first();

        $date = Carbon::parse($dateCreated->created_at)->format('F, d Y   g:i a');

        return view('viewClientReference', ['client' => $client, 'date_created' => $date]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'client_name' => 'required',
            'email' => 'required|email|unique',
            'tel_no' => 'required|min:7|max:7',
            'mob_no' => 'required|min:10|max:11',
            'address' => 'required'
        ],
        [
            'client_name.required' => 'Client First Name is required.',
            'email.required' => 'Please Input a valid Email',
            'email.email' => 'Email is not valid',
            'email.required' => 'Email already exists',
            'tel_no.required' => 'Telephone is required.',
            'mob_no.required' => 'Please Input a valid Mobile Number ex.091223456789.',
            'address.required' => 'Please Input a valid Address.'
        ]);
        
        $client = DB::table('client')
        ->where('client_id', '=', $id)
        ->update([
            'client_name' => $request->input('client_name'),
            'email' => $request->input('email'),
            'tel_no' => $request->input('tel_no'),
            'mob_no' => $request->input('mob_no'),
            'address' => $request->input('address'),
        ]);

        $clientName = DB::table('client')
        ->select('client_name')
        ->where('client_id', '=', $id)
        ->first();

        return redirect('/viewCreateCLient')->with('success', 'Client'.$clientName.'Information was Updated!');
    }

    public function destroy($id)
    {
        //
        $item = DB::table('client')
        ->where('client_id', '=', $id)
        ->update([
            'disabled_at' => Carbon::now(),
        ]);

        $clientName = DB::table('client')
        ->select('client_name')
        ->where('client_id', '=', $id)
        ->first();

        return redirect('client')->with('success', 'Client'.$clientName.'\'s reference is now Disabled');
    }
}
