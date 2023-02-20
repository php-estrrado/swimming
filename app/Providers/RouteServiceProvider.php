<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $adminnamespace = 'App\Http\Controllers\Admin';
    protected $apinamespace = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot() {
        //

        parent::boot();
    }

    /**
     *
     * @return void
     */
    public function map() {
        //$this->mapCacheRoutes();
        $this->mapAdminRoutes();
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes() {
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes() {
        Route::middleware('admin')
                ->namespace($this->adminnamespace)
                ->group(base_path('routes/admin/admin.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() {
        Route::prefix('api')
                ->middleware('api')
                ->namespace($this->apinamespace)
                ->group(base_path('routes/api.php'));
    }
    
    protected function mapCacheRoutes() {
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/cache.php'));
    }

}
