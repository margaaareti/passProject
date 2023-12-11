<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PeopleApplication extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'user_id',
        'application_number',
        'is_approved',
        'signed_by',
        'start_date', 'end_date',
        'object', 'purpose',
        'rooms',
        'guests_count',
        'contract_number',
        'equipment',
        'phone_number',
        'responsible_person',

    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];


    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class, 'form_guests');
    }

}
