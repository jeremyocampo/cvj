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
    public function is_max(){
        return ($this->quantity == $this->total_items_received()) ? true : false;
    }
    
    public function total_items_received(){
        $po_item_rcvd = PurchaseOrderItemAdd::where('po_item_id','=',$this->id)->sum('quantity');
        return (is_null($po_item_rcvd) ? 0 : $po_item_rcvd );
    }
}
