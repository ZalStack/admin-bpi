<?php

namespace App\Http\Middleware;

use App\Models\Bahasa;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale');

        if (! $locale || ! Bahasa::isValidKodeCached($locale)) {
            $locale = Bahasa::defaultKodeCached();
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
