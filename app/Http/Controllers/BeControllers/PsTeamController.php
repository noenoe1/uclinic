<?php

namespace App\Http\Controllers\BeControllers;

use Laravel\Jetstream\Http\Controllers\Inertia\TeamController;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


class PsTeamController extends TeamController
{    
    public function __construct() {
        $this->middleware(function ($request, $next) {
                $this->user_info=Auth::user();
                $this->initShareData($this->user_info);
            return $next($request);
        });
    }

    public function initShareData($user) {
        if($user != null) {
            Inertia::share('isDarkMode', Cache::get($user->id));
        }
    }
}
