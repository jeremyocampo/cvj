<?php

namespace App\Http\Controllers;

use App\categoryRef;
use App\Dish;
use App\Http\Requests\DishRequest;
use App\Items;
use Google\Auth\Cache\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['dishes'] = Dish::all();

        return view('dish-list', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = categoryRef::all();
        $items = Items::all();

        return view('dish-create', compact('categories', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        //

        Dish::create($request->all());

        return redirect('/dishes')->with('success', 'Dish Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //

        $data['dish'] = $dish;
        $data['items'] = Items::all();
        $data['categories'] = categoryRef::all();

        return view('dish-update', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DishRequest  $request
     * @param $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //

        Dish::find($id)->update($request->all());
        return redirect('/dishes')->with('success', 'Dish Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //

        Dish::destroy($dish->id);

        return redirect('/dishes')->with('success', 'Dish Deleted!');

    }

    public function disable(){

        $data['dishes'] = Dish::onlyTrashed()->get();

        return view('dish-disabled', $data);

    }

    public function recoverDish($id){


        Dish::withTrashed()->find($id)->restore();

        return redirect('/disabled-dishes')->with('success', 'Dish Enabled');

    }
}
