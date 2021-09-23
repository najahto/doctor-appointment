<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getAMWorkingTimes()
    {
        return  [
            '06:00', '06:20', '06:40', '07:00', '07:20', '07:40', '08:00', '08:20',
            '08:40', '09:00', '09:20', '09:40', '10:00', '10:20', '10:40', '11:00',
            '11:20', '11:40'
        ];
    }

    public static function getPMWorkingTimes()
    {
        return [
            '12:00', '12:20', '12:40', '01:00', '01:20', '01:40', '2:00', '02:20',
            '02:40', '03:00', '03:20', '03:40', '04:00', '04:20', '04:40', '05:00',
            '05:20', '05:40', '06:00', '06:20', '06:40', '07:00', '07:20', '07:40',
            '08:00', '08:20', '08:40', '09:00', '09:20', '09:40'
        ];
    }
}