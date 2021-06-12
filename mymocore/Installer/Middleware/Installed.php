<?php
/**
 * MYMO CMS - Free Laravel CMS
 *
 * @package    mymocms/mymocms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://github.com/mymocms/mymocms
 * @license    MIT
 *
 * Created by The Anh.
 * Date: 6/12/2021
 * Time: 5:58 PM
 */

namespace Mymo\Installer\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Mymo\Installer\Helpers\Intaller;

class Installed
{
    public function handle($request, Closure $next)
    {
        if (!Intaller::alreadyInstalled()) {
            if (strpos(Route::currentRouteName(), 'Installer::') === false) {
                return redirect()->route('Installer::welcome');
            }
        }

        return $next($request);
    }
}