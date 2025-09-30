<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * The path to the "home" route for your application.
   *
   * This is used by Laravel authentication to redirect users after login.
   *
   * @var string
   */
  public const HOME = '/home';

  /**
   * Define your route model bindings, pattern filters, etc.
   */
  public function boot(): void
  {
    $this->routes(function () {
      // API routes: automatically prefixed with /api and use api middleware
      Route::middleware('api')
        ->prefix('api')
        ->group(base_path('routes/api.php'));

      // Web routes: use web middleware, no prefix
      Route::middleware('web')
        ->group(base_path('routes/web.php'));
    });
  }
}
