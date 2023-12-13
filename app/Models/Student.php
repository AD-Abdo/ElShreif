<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable =['name','phone','phone2','date','barcode','row_id','user_create','status'];

    protected $hidden = ['created_at','updated_at'];

    public function Row()
    {
        return $this->belongsTo(Row::class,'row_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function StudentAttendance()
    {
        return $this->hasMany(StudentAttendance::class);
    }
    public function Salary()
    {
        return $this->hasMany(Salary::class);
    }

	public function getSalary()
    {
		$month = now()->month;
	  	$year = now()->year;
		return $this->hasOne(Salary::class)->whereMonth('date',$month)->whereYear('date',$year);
    }

}
