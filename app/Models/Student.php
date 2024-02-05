<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    use HasFactory;
    protected $fillable = [
        'lastname',
        'firstname',
    ];
    public function studentsection()
    {
        return $this->hasMany(StudentSection::class);
    }
    public function skillstudent()
    {
        return $this->hasMany(SkillStudent::class);
    }
    public function lessonstudent()
    {
        return $this->hasMany(LessonStudent::class);
    }
    public function criteriastudent()
    {
        return $this->hasMany(CriteriaStudent::class);
    }
}
