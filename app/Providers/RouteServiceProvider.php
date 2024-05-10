<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::prefix('api/user')->middleware('api')
                ->namespace(App\Http\Controllers\API\user::class)
                ->name('user.')->group(base_path('routes/api/user.php'));
            Route::prefix('api/admin')->middleware('api')
                ->namespace(App\Http\Controllers\API\admin::class)
                ->name('admin.')->group(base_path('routes/api/admin.php'));
        });
    }
}
