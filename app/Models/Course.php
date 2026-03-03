<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'capacity'
    ];

    // Many-to-many relationship with Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->withTimestamps();
    }
}