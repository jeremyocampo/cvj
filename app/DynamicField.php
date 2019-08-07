<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicField extends Model
{
    public $primaryKey = 'package_id';
    public $table = 'package';
    public $timestamps = false;
    public $fillable = [
        'package_id', 
        'package_name', 
        'price', 
        
    ];
}
