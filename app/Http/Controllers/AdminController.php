<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        // return view('adminhome');

        if(auth()->user()->userType == 1){
            return view('adminhome');
        } else if (auth()->user()->userType == 2){
            return view('admin');
        }
    }
    public function admin()
    {
        return view('admin');
    }
}
