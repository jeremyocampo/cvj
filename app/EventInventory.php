<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Items;
use App\InventoryModel;
class EventInventory extends Model
{

    public $timestamps = false;
    public $table = 'event_inventory';

    public $primaryKey = 'einventory_id';
    public function inventory(){
        return InventoryModel::where('inventory_id','=',$this->inventory_id)->first();
    }
}