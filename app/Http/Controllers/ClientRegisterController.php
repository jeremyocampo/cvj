<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ClientAccountModel;
use Session;

class ClientRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("eventbookingpage.register");
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
        // $loginDet = [
        //     "client_id" => "Admin",
        //     "password" => "123456"
        // ];
        // Session::put('loginDetails', $loginDet);
        // $loginDetails = Session::get('loginDetails');
        
        Session::put('loginDetails', $loginDet);

        $this->validate($request, [
            'clientFName' => 'required',
            'clientLName' => 'required',
            'clientEmail' => 'required|email',
            'client_id' => 'required|unique:client',
            'clientPassword' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            //'clientPassword' => 'required',
            'telNo' => 'required|min:7|max:7',
            'faxNo' => 'max:7',
            'mobileNo' => 'required|min:10|max:11',
            'clientAddress' => 'required'
        ],
        [
            'clientFName.required' => 'Client First Name is required.',
            'clientLName.required' => 'Client Last Name is required.',
            'clientEmail.required' => 'Email Invalid',
            'client_id.unique' => 'Username already exists. Please choose another one.',
            'clientPassword.min' => 'The password must be at least 8 characters.',
            'clientPassword.confirmed' => 'Password Confirmation does not match',
            'clientPassword.regex' => 'The password must have atleast 1 uppercase and lowercase letter, and 1 numeric character.',
            'telNo.required' => 'Telephone is required.',
            'mobileNo.required' => 'Mobile Number is required.',
            'clientAddress.required' => 'Address is required.'
        ]);
        
        $client = new ClientAccountModel([
            // 'client_id' => $loginDetails['account_id'],
            'client_FN' => $request->input('clientFName'),
            'client_LN' => $request->input('clientLName'),
            'email' => $request->input('clientEmail'),
            'client_id' => $request->input('client_id'),
            'password' => bcrypt($request->input('clientPassword')),
            'tel_no' => $request->input('telNo'),
            'fax_no' => $request->input('faxNo'),
            'mob_no' => $request->input('mobileNo'),
            'address' => $request->input('clientAddress'),
        ]);
        $client->save();


        $event = DB::table('event')
            // ->join('client_ref','event.client_name','=','client_ref.client_name')
            // ->join('event','client_ref.client_name','=','event.client_name')
            ->get();
        //dd($joinedTable);
        
        $packages = DB::table('package')
            // ->join('package','event.package_id','=','package.package_id')
            // ->join('event','package.package_id','=','event.package_id')
            ->get();
 
        // $status = "Account successfully created!";
        //return view('eventbookingpage.bookevent', compact('client', 'packages', 'status'));
        return redirect('/bookevent')
            ->with('success', "Account successfully created!")
            ->with('event', $event)
            ->with('packages', $packages);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
