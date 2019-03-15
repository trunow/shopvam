<?php

namespace Trunow\Shopvam;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use App\Services\UserTypePermissions as Permissions;

class ShopvamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton('current_user_permiss', function(){
            return new Permissions();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views')]);
        $this->publishes([__DIR__ . '/../config' => config_path()]);
        $this->publishes([__DIR__ . '/../app' => app_path()]);

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'shopvam');

    }

}