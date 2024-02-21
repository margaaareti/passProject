<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CarApplication extends Application
{
    use HasFactory;

    protected $fillable = [
        'cars_count',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class, 'form_cars');
    }

    public function application(): MorphOne
    {
        return $this->morphOne(Application::class, 'applicationable');
    }

    public function getName():string
    {
        return "Заявка на въезд автотранспорта №";
    }

    public function getUrl():string
    {
        return "showCarApp";
    }

    public function getType():string
    {
        return "cars";
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
