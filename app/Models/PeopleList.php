<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PeopleList extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'signed_by',
        'start_date', 'end_date',
        'object', 'purpose',
        'guests_count',
        'contract_number',
        'equipment',
        'phone_number'

    ];


    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function guests() {
        return $this->belongsToMany(Guest::class, 'form_guests');
    }

}
