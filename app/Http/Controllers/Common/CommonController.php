<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller
{
    public function toggleDarkMode(Request $request) {

        $isDarkMode = $request->isDarkMode;
        
        $user_id = Auth::id();
        $status = false;
        if($user_id != null && $user_id != "") {
            if($isDarkMode != null) {
                $status = Cache::get($user_id);
                Cache::put($user_id, !$status);
            }else {
                Cache::put($user_id, !$isDarkMode);
            }
            Inertia::share('isDarkMode', Cache::get($user_id));  
        }else {
            if($isDarkMode != null) {
                $sessionId = Session::getId();
                $status = Cache::get($sessionId);
                Cache::put($sessionId, !$status);
            }else {
                Cache::put($user_id, !$isDarkMode);
            }
            if($sessionId != null) {
                Inertia::share('isDarkMode', Cache::get($sessionId));
            }            
        }
        return $status;
        //return Session::getId();
    }
}
