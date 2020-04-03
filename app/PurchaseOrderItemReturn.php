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
    
    public $table = 'purchase_order_item_return';

    public $primaryKey = 'id';
    public $timestamps = false;

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrderNew::class);
    }
    public function inventory(){
        return inventory::where('inventory_id','=',$this->inventory_id)->first();
    }
}
