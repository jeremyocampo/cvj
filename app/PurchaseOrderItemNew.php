<?php

namespace App;

use App\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;


class PurchaseOrderItemNew extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    
    public $table = 'purchase_order_item';

    public $primaryKey = 'id';
    public $timestamps = false;

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrderNew::class);
    }
    public function inventory(){
        return inventory::where('inventory_id','=',$this->inventory_id)->first();
    }
    public function total(){
        return $this->rate * $this->quantity;
    }
}
