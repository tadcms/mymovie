<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/laravel-cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Ecommerce\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\Ecommerce\Supports\CartInterface;

class AutoloadSeviceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $basePath = __DIR__ . '/..';
        $this->loadViewsFrom($basePath . '/resources/views', 'ecom');
        $this->loadTranslationsFrom($basePath . '/resources/lang', 'ecom');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/ecommerce.php',
            'ecommerce'
        );
        
        $this->publishes(
            [
                plugin_path('juzaweb/ecommerce', 'src/resources/assets/public')
                => base_path('public/jw-styles/plugins/ecommerce/assets')
            ],
            'ecom_assets'
        );
    
        $this->app->register(RouteServiceProvider::class);
    
        $this->app->bind(
            CartInterface::class,
            config('ecommerce.cart')
        );
    }
}
