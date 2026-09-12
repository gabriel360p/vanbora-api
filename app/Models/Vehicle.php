<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Trip;
class Vehicle extends Model
{
    protected $fillable = [
        "driver_id","plate","photo","capacity","status",
    ];

    protected $casts=[
        'photos_path',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function trip(){
        return $this->belongsToMany(Trip::class);
    }
}
