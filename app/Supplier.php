<?php

namespace App;

use App\ContactPerson;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'name',
        'email',
        'landline',
        'fax',
        'mobile',
        'payment_terms',
        'company_address',
        'billing_address',
        'supplier_type',
        'remarks',
        'is_enabled'
    ];

    public function contacts()
    {
        return $this->hasMany(ContactPerson::class, 'supplier_id', 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(SupplierItem::class, 'supplier_id', 'supplier_id');
    }
}
