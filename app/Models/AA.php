<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AA extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lesson_id',
    ];

    public function criteria()
    {
        return $this->hasMany(Criteria::class, "a_a_s_id");

    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
