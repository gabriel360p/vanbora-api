<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Trip;
class Vehicle extends Model
{
    protected $fillable = [
        "user_id","plate","capacity","status","photos_path",
    ];

    protected $casts=[
        'photos_path'=>'array',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trip(){
        return $this->belongsToMany(Trip::class);
    }
}
