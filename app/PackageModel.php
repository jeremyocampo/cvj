<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    //
    public $primaryKey = 'package_id';
    //public $incrementing = false;
    public $table = 'package';
    public $timestamps = false;
    public $fillable = [
    	'package_name', 'price', 'package_type',
    ];
}
