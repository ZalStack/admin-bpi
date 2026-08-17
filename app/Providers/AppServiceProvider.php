<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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
    }
}
