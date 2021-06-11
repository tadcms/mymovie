<?php

namespace Plugins\Movie\Http\Controllers\Frontend\Auth;

use App\Core\User;
use Illuminate\Http\Request;
use Mymo\Core\Http\Controllers\FrontendController;

class LoginController extends FrontendController
{
    public function index()
    {
    
    }
    
    public function login(Request $request)
    {
        $this->validateRequest([
            'email' => 'required|email',
            'password' => 'required',
        ], $request, [
            'email' => trans('mymo::app.email'),
            'password' => trans('mymo::app.password'),
        ]);
        
        if (get_config('google_recaptcha')) {
            $this->validateRequest([
                'recaptcha' => 'required|recaptcha',
            ], $request);
        }
        
        $user_exists = User::where('email', '=', $request->post('email'))
            ->where('status', '=', 1)
            ->exists();
        
        if ($user_exists) {
            if (\Auth::attempt($request->only(['email', 'password']), 1)) {
                return response()->json([
                    'status' => 'success',
                    'message' => trans('mymo::app.logged_successfully'),
                ]);
            }
        }
        
        return response()->json([
            'status' => 'error',
            'message' => trans('mymo::app.email_or_password_is_incorrect'),
        ]);
     }
    
    public function logout() {
        if (\Auth::check()) {
            \Auth::logout();
        }
        
        return redirect()->route('home');
    }
}
