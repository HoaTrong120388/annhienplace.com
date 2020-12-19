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
        // view()->composer(['backend/partials/nav'], 'App\Http\ViewComposers\CountContactNew');
        view()->composer(['frontend/partials/header/header-nav'], 'App\Http\ViewComposers\FrontendCatalog');
        view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendPost');
        view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendNews');
        view()->composer(['frontend/common/sidebar'], 'App\Http\ViewComposers\FrontendImage');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
