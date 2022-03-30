<?php

namespace Juzaweb\Tool\Providers;

use Juzaweb\Facades\ActionRegister;
use Juzaweb\Support\ServiceProvider;
use Juzaweb\Tool\ToolAction;

class ToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ActionRegister::register([
            ToolAction::class
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
