<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use DateTime;

class Employee extends Model
{

    public $timestamps = false;
    public $table = 'employee';
    public $primaryKey = 'employee_id';
    public function get_shift_times_on_date($date){

        $date_time = new DateTime($date);
        $date_name = $date_time->format('l');
        error_log("date_name: ".$date_name);
        $manpower = Manpower::where('email','=',$this->email)->first();
        $schedule = Schedules::where('id','=',$manpower->schedule_id)->first();

        switch ($date_name) {
            case 'Monday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            case 'Tuesday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            case 'Wednesday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            case 'Thursday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            case 'Friday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            case 'Saturday':
                return array('in'=>$schedule->monday_in_time,'out'=>$schedule->monday_out_time,'shift_name'=>$schedule->shift_name);
        break;
            default:
                return array('in'=>$schedule->sunday_in_time,'out'=>$schedule->sunday_out_time,'shift_name'=>$schedule->shift_name);
        }

    }
}