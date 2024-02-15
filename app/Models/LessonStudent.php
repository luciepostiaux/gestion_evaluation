<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'lesson_id',
    ];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
