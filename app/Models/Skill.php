<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    public function skillstudent()
    {
        return $this->hasMany(SkillStudent::class);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
