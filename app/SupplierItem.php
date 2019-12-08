<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
    */
    protected $table = 'supplier_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item',
        'rate',
        'is_active'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
