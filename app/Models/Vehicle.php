<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        "driver_id","plate","photo","capacity","status",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trip(){
        return $this->belongsToMany(Trip::class);
    }
}
