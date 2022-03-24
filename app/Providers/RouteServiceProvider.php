<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// libraries I need
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            // AUTH Routes
            Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
                ->prefix(LaravelLocalization::setLocale())
                ->namespace($this->namespace)
                ->group(function () {
                    Auth::routes();
                });

            // Website Routes
            Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
                ->prefix(LaravelLocalization::setLocale())
                ->namespace($this->namespace . '\Website')
                ->group(base_path('routes/web.php'));

            // Admin Routes
            Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth', 'admin'])
                ->prefix(LaravelLocalization::setLocale() . '/admin')
                ->namespace($this->namespace . '\Admin')
                ->group(base_path('routes/admin.php'));

            // Vendor Routes
            Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth', 'vendor'])
                ->prefix(LaravelLocalization::setLocale() . '/vendor')
                ->namespace($this->namespace . '\Vendor')
                ->group(base_path('routes/vendor.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
