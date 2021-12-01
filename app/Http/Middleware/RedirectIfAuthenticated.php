<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard) {
            case 'student':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('student_home');
                }
                break;
            case 'teacher':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('teacher_home');
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
        }
        //if (Auth::guard($guard)->check()) {
            //return redirect(RouteServiceProvider::HOME);
        //}

        return $next($request);
    }
}
