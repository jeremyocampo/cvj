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
    public function temp_reference_number(){
        return PurchaseOrderNew::max('purchase_order_id')+1;
    }
    public function items()
    {
        return PurchaseOrderItemNew::where('purchase_order_id','=',$this->purchase_order_id)->get();
    }
    public function is_max(){
        return ($this->receive_status() == 2) ? true : false;
    }
    public function receive_status(){
        $rcvd = $this->total_items_received();
        if($rcvd == $this->totalQuantity()){
            return 2;
        }
        if($rcvd == 0){
            return 0;
        }
        return 1;
    }
    public function status_update(){
        if($this->receive_status() == 2 && $this->status != 'returned'){
            $this->status = 'received';
            $this->save();
        }
    }
    public function return_items(){
        $this->status = 'returned';
        $this->save();
    }
    public function total_items_received(){
        $po_items = $this->items();
        $itm=0;
        foreach($po_items as $po_item){
            $itm += $po_item->total_items_received();
        }
        return $itm;
    }
    
    public function receive_status_text($num){
        switch($num){
            case 0:
                return "No items received yet.";
            case 1:
                return "Items partially received.";
            case 2:
                return "All items received.";
        }
    }
    public function total()
    {
        $total = 0;
        $items = $this->items();

        foreach($items as $item) {
            $total += $item->total();
        }
        
        return $total;
    }

    public function totalQuantity()
    {
        $total = 0;
        $items = $this->items();

        foreach($items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }
}
