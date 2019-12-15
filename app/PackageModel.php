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
    public function reset_package_additions($event_id){
        // Code goes here
        $p_inventories = EventInventory::where('event_id','=',$event_id)->where('is_addition','=',true)->get();
        $p_items = EventDishes::where('event_id','=',$event_id)->where('is_addition','=',true)->get();
        foreach($p_inventories as $p_inventory){
            $p_inventory->delete();
        }
        foreach ($p_items as $p_item){
            $p_item->delete();
        }
        return true;
    }
    public function check_package_event_inv_warning(){

    }
}
