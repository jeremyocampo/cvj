<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryModel extends Model
{
    public $primaryKey = 'inventory_id';
    public $table = 'inventory';
    public $timestamps = false;
    public $fillable = [
        'inventory_id', 
        'inventory_name', 
        'rental_cost',
}
