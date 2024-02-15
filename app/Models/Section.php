<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name',
    ];
    use HasFactory;
    public function studentsection()
    {
        return $this->hasMany(StudentSection::class);
    }
}
