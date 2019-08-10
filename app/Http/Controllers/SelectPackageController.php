<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackageModel;
use Session;

class SelectPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('selectpackages');
        // return 1;
        
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

        $appetizersSelected = array();
        //FOR APPETIZERS
        for ($i = 0; $i < 6; $i++){
            $tempName = "appetizer".$i;
            if ($request->input($tempName)!=null){
                array_push($appetizersSelected, $request->input($tempName));
            }
        }

        dd($appetizersSelected);

        // $client = null;
        // $packages = 
        
        $items = new PackageModel();
        $items->item_name = $request->$appetizersSelected[0];
        if($request->input('custom') != ""){
            $items->package_id = 2;
        }
        $items->rawmaterial_id = $request->input('quantity');

       
        //$inventory->last_modified = Carbon::now();
        $items->save();

        $success = "Packages Selected!";
        return redirect('/summary', compact('client', 'packages', 'success'));
        
        
        // return redirect('/summary')
        // ->with('success', "Packages Selected!")
        // ->with('client', $client)
        // ->with('packages', $packages);
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
