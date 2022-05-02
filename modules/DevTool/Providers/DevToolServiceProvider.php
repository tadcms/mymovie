<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\DevTool\Providers;

use Illuminate\Database\Query\Builder;
use Juzaweb\CMS\Providers\TelescopeServiceProvider;
use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Support\Stub;

class DevToolServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->environment('local')) {
            $this->app->register(TelescopeServiceProvider::class);

            Builder::macro(
                'toRawSql',
                function () {
                    return array_reduce(
                        $this->getBindings(),
                        function ($sql, $binding) {
                            return preg_replace(
                                '/\?/',
                                is_numeric($binding) ? $binding : "'".$binding."'",
                                $sql,
                                1
                            );
                        },
                        $this->toSql()
                    );
                }
            );
        }
    }

    public function register()
    {
        $this->setupStubPath();

        if ($this->app->runningInConsole() || $this->app->runningUnitTests()) {
            $this->app->register(ConsoleServiceProvider::class);
        }
    }

    /**
     * Setup stub path.
     */
    public function setupStubPath(): void
    {
        Stub::setBasePath(__DIR__ . '/../stubs/plugin');
    }
}
