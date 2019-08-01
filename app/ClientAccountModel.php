<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAccountModel extends Model
{
    //
    public $primaryKey = 'client_id';
    public $table = 'client';
    public $timestamps = false;
    public $fillable = [
        'client_id', 
        'password',
        'client_FN',
        'client_LN', 
        'email', 
        'tel_no', 
        'fax_no',
        'mob_no', 
        'address',
        'status',
    
    ];

}
