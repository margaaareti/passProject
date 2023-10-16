<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
      'number'
    ];


    public function form():BelongsToMany
    {
        return $this->belongsToMany(CarApplication::class, 'form_cars');
    }
}
