<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $filable = ['name','user_create'];

    protected $hidden = ['created_at','updated_at'];

    public function Students()
    {
        return $this->hasMany(Student::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
}
