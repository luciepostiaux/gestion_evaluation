<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public function lessonstudent()
    {
        return $this->hasMany(LessonStudent::class);
    }
    public function aa()
    {
        return $this->hasMany(AA::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
