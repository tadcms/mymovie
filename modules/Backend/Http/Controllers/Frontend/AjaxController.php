<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Backend\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Juzaweb\Backend\Facades\HookAction;

class AjaxController extends FrontendController
{
    public function ajax($key, Request $request)
    {
        $key = str_replace('/', '.', $key);
        $ajax = HookAction::getFrontendAjaxs($key);
        
        if (empty($ajax)) {
            return response('Ajax function not found.', 404);
        }

        if ($ajax->get('auth') && !Auth::check()) {
            return response('You do not have permission to access this link.', 403);
        }

        if ($method = $ajax->get('method')) {
            $method = Str::upper($method);
            if ($request->method() != $method) {
                return response('Method is not supported.', 403);
            }
        }

        $callback = $ajax->get('callback');
        if (is_string($callback[0])) {
            return App::call([app($callback[0]), $callback[1]]);
        }
        
        return App::call($callback);
    }
}
