<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Client extends Model
{
    public $primaryKey = 'client_id';
    public $table = 'client';
    public $timestamps = false;
    
    protected $fillable = [
        'client_name', 'email', 'tel_no', 'mob_no', 'address', 'user_id', 'updated_at', 'created_at' 
    ];
}