<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'department_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
