<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'semester_name',
        'start_date',
        'end_date',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
