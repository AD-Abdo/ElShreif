<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;
    protected $fillable =['teacher_id','month','date','year','comment','salary','user_create'];

    protected $hidden = ['created_at','updated_at'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function Teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
