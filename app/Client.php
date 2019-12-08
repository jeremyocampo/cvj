<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $primaryKey = 'client_id';
    public $table = 'client';
<<<<<<< HEAD
    public $timestamps = false;
    
    protected $fillable = [
        'client_name', 'email', 'tel_no', 'mob_no', 'address', 'user_id', 'updated_at', 'created_at' 
    ];
=======
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
}