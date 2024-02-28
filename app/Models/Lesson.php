<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'section_id',
    ];

    public function lessonstudent()
    {
        return $this->hasMany(LessonStudent::class);
    }
    public function aas()
    {
        return $this->hasMany(AA::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
