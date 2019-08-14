<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageModel extends Model
{
    //
    public $table = 'package';
    protected $primaryKey = 'package_id';
    public $timestamps = false;
}
