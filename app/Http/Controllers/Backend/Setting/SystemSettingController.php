<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Models\Configs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemSettingController extends Controller
{
    public function index($form = null) {
        if (empty($form)) {
            $form = 'general';
        }
        
        if (!view()->exists('backend.setting.system.form.' . $form)) {
            $form = 'general';
        }
        
        $form_content = view('backend.setting.system.form.' . $form)->render();
        
        return view('backend.setting.system.index', [
            'title' => trans('app.system_setting'),
            'form' => $form,
            'form_content' => $form_content,
            'settings' => $this->settingList(),
        ]);
    }
    
    public function save(Request $request) {
        $configs = $request->only(Configs::getConfigs());
        foreach ($configs as $key => $config) {
            if ($request->has($key)) {
                Configs::setConfig($key, $config);
            }
        }
    
        $form = $request->post('form');
        if (empty($form)) {
            $form = 'general';
        }
        
        return response()->json([
            'status' => 'success',
            'message' => trans('app.saved_successfully'),
            'redirect' => route('admin.setting.form', [$form]),
        ]);
    }
    
    protected function settingList() {
        return [
            'general' => trans('app.site_info'),
            'recaptcha' => trans('app.google_recaptcha'),
            'player' => trans('app.player'),
            'stream3s' => trans('app.stream3s_stream'),
            'paid-members' => trans('app.paid_members'),
        ];
    }
}
