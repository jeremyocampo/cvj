<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    //
    public $primaryKey = 'id';
    public $table = 'users';
    public $timestamps = false;
    public $fillable = [
        'name', 
        'email', 
        'password', 
        'updated_at', 
        'tel_no',
        'mob_no',
        'address', 
    ];
}

