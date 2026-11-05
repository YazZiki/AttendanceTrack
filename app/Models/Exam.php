<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_type_id',
        'exam_date',
        'exam_time',
        'duration',
        'max_grade',
        'min_grade',
        'section_id',
        'course_id',
        'room',
    ];

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}