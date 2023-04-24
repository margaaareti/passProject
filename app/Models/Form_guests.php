<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_guests extends Model
{
    use HasFactory;

    protected $fillable = [

        "people_list_id", "guest_id"

    ];


    public function form() {
        return $this->belongsTo(PeopleList::class);
    }

    public function guest() {
        return $this->belongsTo(Guest::class);
    }
}
