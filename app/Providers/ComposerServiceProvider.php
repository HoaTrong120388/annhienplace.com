<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['frontend/partials/header/mega-nav'], 'App\Http\ViewComposers\FrontendCatalog');
        // view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendPost');
        // view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendNews');
        // view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendImage');
    }

    public function register()
    {
        //
    }
}
