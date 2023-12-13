<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable =['status','salary','notes','admin_notes','date','student_id','user_create'];

    protected $hidden = ['created_at','updated_at'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function Student()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }
}
