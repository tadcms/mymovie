<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        \Validator::extend('recaptcha', 'App\Validators\Recaptcha@validate');
        $this->loadMigrationsFrom($paths);
        \Schema::defaultStringLength(191);
		if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && !empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
			if ($_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
				\URL::forceScheme('https');
			}
		}
        else {
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
				\URL::forceScheme('https');
			}
        }
    }
}
