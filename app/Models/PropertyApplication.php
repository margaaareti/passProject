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
        'type',
        'object_in','object_out',
    ];

    protected $casts = [
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

    public function getApplicationType(): string
    {
        return $this->getMorphClass();
    }

    public function getApplicationId(): int
    {
        return $this->id;
    }

}
