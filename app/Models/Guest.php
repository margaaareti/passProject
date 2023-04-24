<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
      'name'
    ];


    public function form() {
        return $this->belongsToMany(PeopleList::class, 'form_guests');
    }
}
