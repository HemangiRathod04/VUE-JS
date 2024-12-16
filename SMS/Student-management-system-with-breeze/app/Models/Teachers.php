<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{

    protected $appends = ['picture_url'];

    use HasFactory;

    public function getPictureUrlAttribute()
    {
        return $this->picture ? asset('storage/pictures/' . $this->picture) : null;
    }
   
}
