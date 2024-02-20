<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PeopleApplication extends Application
{
    use HasFactory;

    protected $fillable = [

        'name',
        'user_id',
        'application_number',
        'application_type',
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
        'approved_by',
        'viewed'

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

    public function application(): MorphOne
    {
        return $this->morphOne(Application::class, 'applicationable');
    }

    public function getName():string
    {
        return "Заявка на проход посетителей №";
    }

    public function getUrl():string
    {
        return "showGuestApp";
    }

    public function getType():string
    {
        return "guests";
    }

}
