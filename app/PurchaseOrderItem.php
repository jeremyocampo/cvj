<?php

namespace App;

use App\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_order_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function total_items_received(){
        return PurchaseOrderItemAdd::where('po_item_id','=',$this->id)->sum('quantity');
    }

}
