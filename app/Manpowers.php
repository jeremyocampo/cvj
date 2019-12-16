<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manpowers extends Model
{
    //
    protected $primaryKey = 'inventory_deployed';
    //public $incrementing = false;
    protected $table = 'manpowers';
    public $timestamps = true;
    protected $fillable = [
        'employee_fn', 'employee_ln','email', 'agency_id', 'contact_no', 'address','schedule_id','created_at','updated_at','deleted_at','salary',
    ];
}
