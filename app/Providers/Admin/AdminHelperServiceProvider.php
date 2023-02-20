<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;

class AdminHelperServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        foreach (glob(app_path() . '/Helpers/Admin/*.php') as $filename) {
            require_once($filename);
        }
    }

}
