<?php

namespace Aflanry\Menu;

use Aflanry\Menu\NavMenuComposer;
use Aflanry\Menu\SideMenuComposer;
use Illuminate\Support\Facades\View;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('menu::side_menu', SideMenuComposer::class);
        View::composer('menu::nav_menu', NavMenuComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'menu');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/menu'),
            __DIR__.'/js' => resource_path('js/vendor/menu'),
            __DIR__.'/sass' => resource_path('sass/vendor/menu'),
            __DIR__.'/config/menu.php' => config_path('menu.php'),
            __DIR__.'/database/seeds' => database_path('seeds/vendor/menu'),
        ]);
    }
}
