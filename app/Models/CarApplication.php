<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CarApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'signed_by',
        'start_date', 'end_date',
        'object', 'purpose',
        'cars_count',
        //'contract_number',
        'equipment',
        'phone_number',
        'responsible_person',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'form_cars');
    }

}
