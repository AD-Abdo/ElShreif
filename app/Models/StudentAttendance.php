<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $fillable =['student_id','month','date','user_create'];

    protected $hidden = ['created_at','updated_at'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
}
