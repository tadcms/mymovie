<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzawebcms/juzawebcms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://github.com/juzawebcms/juzawebcms
 * @license    MIT
 *
 * Created by JUZAWEB.
 * Date: 5/25/2021
 * Time: 10:10 PM
 */

namespace Juzaweb\Http\Controllers;

use Juzaweb\Abstracts\Action;
use Juzaweb\Backend\Facades\HookAction;
use Juzaweb\Traits\ResponseMessage;
use Inertia\Inertia;
use function Symfony\Component\HttpFoundation\getLanguages;

class BackendController extends Controller
{
    use ResponseMessage;

    public function callAction($method, $parameters)
    {
        do_action(Action::BACKEND_CALL_ACTION, $method, $parameters);
    
        $menuItems = HookAction::getAdminMenu();
        $langs = array_merge(trans('cms::app', [], 'en'), trans('cms::app'));
        
        Inertia::share(
            [
                'menuItems' => $menuItems,
                'lang' => $langs,
            ]
        );

        return parent::callAction($method, $parameters);
    }

    protected function addBreadcrumb(array $item, $name = 'admin')
    {
        add_filters($name . '_breadcrumb', function ($items) use ($item) {
            $items[] = $item;

            return $items;
        });
    }
}
