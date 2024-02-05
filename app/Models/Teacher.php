<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    public function listinglesson(): Collection
    {
        return $this->cours()->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
