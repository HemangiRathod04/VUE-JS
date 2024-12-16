<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'gr_no', 'class_id', 'gender', 'schedule_id', 'date_of_birth', 'status', 'phone','photos_url'
    ];

    protected $appends = ['formatted_title','photos_url'];

    public function Schedule(){
        return $this->belongsTo(Schedules::class,'schedule_id');
    }

    public function getFormattedTitleAttribute(){
        $startTime = Carbon::parse($this->start_time)->format('h:i A');
        $endTime = Carbon::parse($this->end_time)->format('h:i A');
        return "{$this->title} [{$startTime} to {$endTime}]";
    }

    public function getPhotosUrlAttribute()
    {
        return $this->photo ? asset('storage/photos/'.$this->photo):null;
    }
    public function classes()
    {
        return $this->belongsTo(classes::class,'class_id');
    } 
    public function parents(){
        return $this->belongsTo(parents::class,'parents_id');
        
    }

}



