<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Tests\Unit;

use Juzaweb\CMS\Support\Plugin;
use Juzaweb\Tests\TestCase;

class PluginTest extends TestCase
{
    public function testEnable()
    {
        $plugins = app('plugins')->all();
        foreach ($plugins as $plugin) {
            /**
             * @var Plugin $plugin
             */

            $this->printText("Enable {$plugin->getName()}");

            $plugin->enable();

            $this->assertTrue($plugin->isEnabled());
        }

        $this->assertDatabaseHas(
            'configs',
            ['code' => 'plugin_statuses']
        );

        $this->printText("Check Enable DB");
        $dbPlugins = get_config('plugin_statuses', []);
        $dbPlugins = array_keys($dbPlugins);
        $notEnable = collect(array_keys($plugins))
            ->filter(
                function ($item) use ($dbPlugins) {
                    return !in_array($item, $dbPlugins);
                }
            )
            ->all();

        $this->assertTrue(count($notEnable) == 0);
    }

    public function testDisable()
    {
        $plugins = app('plugins')->all();
        foreach ($plugins as $plugin) {
            /**
             * @var Plugin $plugin
             */

            $this->printText("Disable {$plugin->getName()}");

            $plugin->disable();

            $this->assertTrue($plugin->isDisabled());
        }

        $this->printText("Check Enable DB");
        $dbPlugins = get_config('plugin_statuses', []);
        $dbPlugins = array_keys($dbPlugins);
        $this->assertTrue(count($dbPlugins) == 0);
    }
}