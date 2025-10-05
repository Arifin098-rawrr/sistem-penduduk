<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthCustom
{
    public function handle($request, Closure $next)
    {
        if (!Session::get('login')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }
        return $next($request);
    }
}
