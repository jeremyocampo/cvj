<?php

namespace App;

use App\OutsourcedItem;
use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrderItemNew;
use App\PurchaseOrderNew;


class EventOutsourceInventory extends Model
{
    protected $table = 'event_outsource_inventory';

	public $timestamps = false;
	
	public function get_quantity_created()
    {
		$qty_total = 0;
		$pos_ids = PurchaseOrderNew::where('event_id','=',$this->event_id)->pluck('purchase_order_id')->toArray();
		return PurchaseOrderItemNew::where('inventory_id','=',$this->inventory_id)
						->whereIn('purchase_order_id', $pos_ids)->sum('quantity');

		/*
		$po_items = PurchaseOrderItemNew::where('inventory_id','=',$this->inventory_id)->whereIn('purchase_order_id', $pos_ids)->get();
		foreach($po_items as $po_item){
			$qty_total += $po_item->quantity;
		}
		return $qty_total;
		*/
    }

}
/*
 *

create table event_outsource_inventory
(
	event_id int null,
	inventory_id int null,
	quantity int null,
	total_price float null,
	constraint event_outsource_inventory_event_event_id_fk
		foreign key (event_id) references cvjdb.event (event_id),
	constraint event_outsource_inventory_inventory_inventory_id_fk
		foreign key (inventory_id) references cvjdb.inventory (inventory_id)
)
;

create index event_outsource_inventory_event_event_id_fk
	on event_outsource_inventory (event_id)
;

create index event_outsource_inventory_inventory_inventory_id_fk
	on event_outsource_inventory (inventory_id)
;



 */