<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_cars extends Model
{
    use HasFactory;

    protected $fillable = [

        "car_applications_id", "car_id"

    ];


    public function form() {
        return $this->belongsTo(CarApplication::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
