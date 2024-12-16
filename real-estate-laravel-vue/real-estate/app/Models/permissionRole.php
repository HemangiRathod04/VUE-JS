<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissionRole extends Model
{
    use HasFactory;
    protected $table = 'permission_role';

    protected $fillable = ['role_id', 'permission_id'];
    
    public $timestamps = false;
}