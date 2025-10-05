<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class ShareUserData
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('user_id')) {
            $user = User::find(Session::get('user_id'));
            View::share('user', $user);
        }

        return $next($request);
    }
}
