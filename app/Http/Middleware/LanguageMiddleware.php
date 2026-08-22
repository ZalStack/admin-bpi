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

        if (! $locale || ! Bahasa::query()->where('kode', $locale)->where('aktif', true)->exists()) {
            $locale = Bahasa::defaultKode();
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
