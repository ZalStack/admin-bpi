<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Set locale from session
        $locale = Session::get('locale', 'id');
        App::setLocale($locale);

        // Share locale with all views
        View::share('currentLocale', $locale);

        // Rate limiter bernama agar tidak berbagi bucket dengan
        // throttle numerik lain (key numerik hanya domain|uri|ip).
        RateLimiter::for('api-read', function (Request $request) {
            return Limit::perMinute(120)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('kontak-form', function (Request $request) {
            return Limit::perMinute(5)->by('kontak:'.$request->ip());
        });
    }
}
