<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'section_name',
        'course_id',
        'instructor_id',
        'semester_id',
        'capacity',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function enrollments()
    {
        return $this->hasMany(StudentSection::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_section')
            ->withPivot('id', 'registration_date', 'created_at');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
