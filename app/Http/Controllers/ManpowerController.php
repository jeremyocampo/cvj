<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Http\Requests\ManpowerRequest;
use App\Manpower;
use App\Schedules;
use Illuminate\Http\Request;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['manpowers'] = Manpower::all();

        return view('manpower-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data['agencies'] = Agency::all();
        $data['schedules'] = Schedules::all();

        return view('manpower-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManpowerRequest $request)
    {
        //

        Manpower::create($request->all());

        return redirect('/manpowers')->with('success', 'Manpower Created Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manpower  $manpower
     * @return \Illuminate\Http\Response
     */
    public function show(Manpower $manpower)
    {
        //
        $data['agencies'] = Agency::all();
        $data['schedules'] = Schedules::all();
        $data['manpower'] = Manpower::find($manpower->id);

        return view('manpower-update', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manpower  $manpower
     * @return \Illuminate\Http\Response
     */
    public function edit(Manpower $manpower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manpower  $manpower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manpower $manpower)
    {
        //

        $request->validate([
           'email' => 'unique:users,email,'.$manpower->id,
        ]);

        Manpower::find($manpower->id)->update($request->all());

        return redirect('/manpowers')->with('success', 'Manpower Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manpower  $manpower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manpower $manpower)
    {
        //

        Manpower::destroy($manpower->id);

        return redirect('/manpowers')->with('success', 'Manpower Disabled Successfully!');
    }

    public function disabled()
    {
        $data['manpowers'] = Manpower::onlyTrashed()->get();

        return view('manpower-disabled', $data);
    }

    public function recover($id){
        Manpower::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Manpower Disabled Successfully!');

    }
}
