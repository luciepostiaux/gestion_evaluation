<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'student_id',
        'criteria_id',
    ];
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
