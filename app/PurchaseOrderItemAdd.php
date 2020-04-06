<?php

namespace App;

use App\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;


class PurchaseOrderItemAdd extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    
    public $table = 'purchase_order_item_add';

    public $primaryKey = 'id';
    public $timestamps = false;

    public function purchaseOrderItem()
    {
        return PurchaseOrderItemNew::where('id','=',$this->po_item_id)->first();
        //return $this->belongsTo(PurchaseOrderItemNew::class);
    }
    public function total(){
        $poi_obj = PurchaseOrderItemNew::where('id','=',$this->po_item_id)->first();
        return $this->quantity * $poi_obj->rate;
    }
    public function inventory(){
        return inventory::where('inventory_id','=',$this->purchaseOrderItem()->inventory_id)->first();
    }
}
