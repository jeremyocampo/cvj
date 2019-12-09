<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    //
    public $table = 'package_item';

    public $primaryKey = 'package_id';
    public $timestamps = false;
}
