<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        {
            Validator::extend('itmo_email', function ($attribute, $value, $parameters, $validator) {
                return preg_match('/@(ifmo|itmo|metalab.ifmo|kronbars|scamt-itmo|oi.ifmo|itz.vuztz|infochemistry|)\.ru$/i', $value);
            });

            Validator::extend('car_number', function ($attribute, $value, $parameters, $validator) {
                return preg_match('/^[а-яА-Я]\s[0-9]{3}\s[а-яА-Я]{2}\s?[0-9]{0,3}$/u', $value);
            });
        }

        Paginator::useBootstrapFive();
    }
}
