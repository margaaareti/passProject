<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'last_name','patronymic',
        'email',
        'password',
        'phone_number',
        'department','isu_number',
        'remember_token',
    ];


    protected $hidden = [
        'password',
        'remember_token'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function peopleList(): HasMany
    {
        return $this->hasMany(PeopleApplication::class);
    }

    public function carList(): HasMany
    {
        return $this->hasMany(CarApplication::class);
    }
}
