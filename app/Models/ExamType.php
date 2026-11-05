<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type_name',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
