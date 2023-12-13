<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_create'];
    protected $hidden = ['created_at','updated_at'];
    public function User()
    {
        return $this->belongsTo(User::class,'user_create','id');
    }
    public function Teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
