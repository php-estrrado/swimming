<?php

namespace App\Providers\Admin;

use Illuminate\Support\ServiceProvider;

class AdminRepositoryServiceProvider extends ServiceProvider {

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

        $repositories = array(
            "App\Contracts\Admin\BaseInterface" => "App\Repositories\Admin\BaseRepository",
            "App\Contracts\Admin\DashboardInterface" => "App\Repositories\Admin\DashboardRepository",
            "App\Contracts\Admin\PageInterface" => "App\Repositories\Admin\PageRepository",
            "App\Contracts\Admin\UserInterface" => "App\Repositories\Admin\UserRepository",
            "App\Contracts\Admin\StaffInterface" => "App\Repositories\Admin\StaffRepository",
            "App\Contracts\Admin\ServiceInterface" => "App\Repositories\Admin\ServiceRepository",
            "App\Contracts\Admin\ProductInterface" => "App\Repositories\Admin\ProductRepository",
            "App\Contracts\Admin\PaymentInterface" => "App\Repositories\Admin\PaymentRepository",
            "App\Contracts\Admin\ReportInterface" => "App\Repositories\Admin\ReportRepository",
            "App\Contracts\Admin\ContactInterface" => "App\Repositories\Admin\ContactRepository",
            "App\Contracts\Admin\FeedbackInterface" => "App\Repositories\Admin\FeedbackRepository",
            "App\Contracts\Admin\WidgetInterface" => "App\Repositories\Admin\WidgetRepository",
            "App\Contracts\Admin\SettingsInterface" => "App\Repositories\Admin\SettingsRepository"
        );

        foreach ($repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

}
