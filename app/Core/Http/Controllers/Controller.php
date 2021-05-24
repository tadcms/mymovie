<?php
/**
 * MYMO CMS - TV Series & Movie Portal CMS Unlimited
 *
 * @package mymocms/mymocms
 * @author The Anh Dang
 *
 * Developed based on Laravel Framework
 * Github: https://github.com/mymocms/mymocms
 */

namespace App\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
    {
        if (!file_exists(storage_path('app/installed'))) {
            if (!in_array(\Route::currentRouteName(), ['install', 'install.submit', 'install.submit.step'])) {
                return redirect()->route('install');
            }
        }
        
        if (config('app.demo') == 'true' && \Auth::id() != 1) {
            if (\request()->isMethod('post')) {
                if (\request()->is('admin-cp/*')) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You cannot change the demo version',
                    ]);
                }
                
                if (\request()->is('account/change-password')) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You cannot change the demo version',
                    ]);
                }
            }
        }
        
        return parent::callAction($method, $parameters);
    }
    
    protected function validateRequest($rules, Request $request, $attributeNames = null) {
        $validator = Validator::make($request->all(), $rules);
        
        if ($attributeNames) {
            $validator->setAttributeNames($attributeNames);
        }
        
        if ($validator->fails()) {
            json_message($validator->errors()->all()[0], 'error');
        }
    }
}