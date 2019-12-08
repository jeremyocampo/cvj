<?php

namespace App;

use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference_number',
        'billing_address',
        'expected_delivery_date',
        'shipment_preferences',
        'status'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
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
