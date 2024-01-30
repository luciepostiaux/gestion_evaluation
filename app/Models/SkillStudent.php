<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillStudent extends Model
{
    use HasFactory;
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
