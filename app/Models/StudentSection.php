<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSection extends Model
{
    protected $table = 'student_section';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'section_id',
        'registration_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}