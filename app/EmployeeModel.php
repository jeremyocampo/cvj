<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EmployeeModel extends Model
{
    public $primaryKey = 'emp_id';
    public $table = 'tblemployee';
    public $fillable = [
        'emp_id',
        'emp_name',
        'emp_contact',
        'emp_address',
        'emp_position',
        'emp_email',
        'emp_password',
        'emp_status'
    ];
}
