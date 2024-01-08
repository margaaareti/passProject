<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'application_number',
        'type',
        'is_approved',
        'signed_by',
        'property-in-date', 'property-out-date',
        'object_in','object_out', 'purpose',
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
}
