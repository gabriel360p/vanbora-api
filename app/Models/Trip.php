<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Trip extends Model
{
    protected $fillable = [
    "user_id",
    "vehicle_id",
    "departure_time",
    "arrival_time",
    "boarding_point",
    "origin",
    "status",
    "price",
    "description",
    "destination",
    "",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function vehicle(){
        return $this->belongsToMany(Vehicle::class);
    }
}
