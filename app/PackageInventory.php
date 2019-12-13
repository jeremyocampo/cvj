<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\inventory;

class PackageInventory extends Model
{
    //
    public $table = 'package_inventory';
    public $primaryKey = 'package_id';
    public $timestamps = false;

    public function is_inventory_available(){
        // Code goes here
        $inv = inventory::where('inventory_id','=',$this->inventory_id)->first();
        if($inv->quantity - $this->quantity < 0){
            return 0;
        }
        return true;
    }
}
