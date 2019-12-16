<?php

namespace App;

use App\OutsourcedItem;
use Illuminate\Database\Eloquent\Model;

class EventOutsourceInventory extends Model
{
    protected $table = 'event_outsource_inventory';

    public $timestamps = false;
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