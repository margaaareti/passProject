<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PropertyApplication extends Application
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'application_number',
        'application_type',
        'type',
        'is_approved',
        'signed_by',
        'property-in-date', 'property-out-date',
        'object_in','object_out', 'purpose',
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

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function application(): MorphOne
    {
        return $this->morphOne(Application::class, 'applicationable');
    }



    public function getName():string
    {
        return "Заявка на внос/вынос имущества №";
    }

    public function getUrl():string
    {
        return "showPropertyApp";
    }

    public function getType():string
    {
        return "properties";
    }


}
