<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AA extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'lesson_id',
    ];

    public function criteria()
    {
        return $this->hasMany(Criteria::class);
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
