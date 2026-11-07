<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'course_code',
        'credit_hours',
        'department_id',
        'instructor_id',
        'semester_id',
        'academic_year',
        'description',
        'prerequisite_id',
        'status',
    ];

    protected $casts = [
        'credit_hours' => 'integer',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Self-referencing relationship: The prerequisite course for this course
    public function prerequisite()
    {
        return $this->belongsTo(Course::class, 'prerequisite_id');
    }

    // Courses that require this course as a prerequisite
    public function dependentCourses()
    {
        return $this->hasMany(Course::class, 'prerequisite_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
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
