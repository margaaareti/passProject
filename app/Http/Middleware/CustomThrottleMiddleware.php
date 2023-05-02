<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CustomThrottleMiddleware
{

    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 1, $decaySeconds = 5)
    {
        $key = $request->ip();

        if ($this->limiter->tooManyAttempts($key, $maxAttempts, $decaySeconds)) {
             abort(429);
        }

        $this->limiter->hit($key, $decaySeconds);

        return $next($request);
    }


}
