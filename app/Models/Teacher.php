<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['name','subject_id','user_create','pay','payDate','payYear'];
    protected $hidden = ['created_at','updated_at'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function Subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
