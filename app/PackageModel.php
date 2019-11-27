<?php

namespace App;

use App\PackageInventory;
use App\PackageItem;
use App\PackageMiscItem;
use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    //
    public $table = 'package';
    protected $primaryKey = 'package_id';
    public $timestamps = false;
    public function reset_package_contents(){
        // Code goes here
        $p_inventories = PackageInventory::where('package_id','=',$this->package_id)->get();
        $p_items = PackageItem::where('package_id','=',$this->package_id)->get();
        foreach($p_inventories as $p_inventory){
            $p_inventory->delete();
        }
        foreach ($p_items as $p_item){
            $p_item->delete();
        }

        return true;
    }
}
