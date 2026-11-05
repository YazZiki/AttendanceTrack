<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    public $timestamps = false;

    protected $fillable = [
        'lecture_id',
        'student_id',
        'status',
        'notes',
        'recorded_at',
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}