<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Set the locale to 'en' (English)
        App::setLocale('en');
        return $next($request);
    }
}
