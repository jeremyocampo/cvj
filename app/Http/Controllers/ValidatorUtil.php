<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidatorUtil extends Controller
{
    //

    public function validateInventory($inventory_name, $category, $color, $size)
    {

        $query = DB::table('inventory')
            ->where('inventory_name', $inventory_name)
            ->where('category', $category)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        if (isset($query)){
            return true;
        }

        return false;

    }
}
