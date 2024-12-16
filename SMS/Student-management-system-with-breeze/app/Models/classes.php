<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->hasMany(students::class, 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teachers::class,'teacher_id');
    }
}
