<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckSuspended
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('web')->check() && auth('web')->user()->suspended_until->gt(Carbon::now()->timestamp)) {
            auth('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('/login')->with('error', 'Your Account is in suspension.');
        }
        return $next($request);
    }
}
