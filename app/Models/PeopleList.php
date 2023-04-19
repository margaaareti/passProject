<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleList extends Model
{
    use HasFactory;

    protected $fillable = [

        'signed_by',
        'start_date', 'end_date',
        'object', 'purpose',
        'guests',
        'contract_number',
        'equipment',
        'phone_number'

    ];

}
