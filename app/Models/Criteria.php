<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    public function criteriastudents()
    {
        return $this->hasMany(CriteriaStudent::class);
    }
    public function aa()
    {
        return $this->belongsTo(AA::class);
    }
}
