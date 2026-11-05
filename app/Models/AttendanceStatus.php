<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
    protected $table = 'attendance_status';
    public $timestamps = false;
    protected $fillable = [
        'status_name',
        ];
}
