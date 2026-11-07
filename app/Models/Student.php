<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'full_name',
        'university_id',
        'national_id',
        'major',
        'year',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Direct access to the enrollment records
    public function enrollments()
    {
        return $this->hasMany(StudentSection::class);
    }

    // Many-to-many access to sections with registration_date
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'student_section')
            ->withPivot('id', 'registration_date', 'created_at');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
