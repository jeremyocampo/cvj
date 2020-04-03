<?php

namespace App;

use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderNew extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $primaryKey = 'purchase_order_id';
    public $timestamps = false;

    public function event(){
        return events::where('event_id','=',$this->event_id)->first();
    }
    public function supplier()
    {
        return  Supplier::where('supplier_id','=',$this->supplier_id)->first();
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItemNew::class);
    }

    public function total()
    {
        $total = 0;
        $items = $this->items()->get();

        foreach($items as $item) {
            $total += $item->total;
        }
        
        return $total;
    }

    public function totalQuantity()
    {
        $total = 0;
        $items = $this->items()->get();

        foreach($items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }
}
