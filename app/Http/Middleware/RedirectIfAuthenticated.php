<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected function userLogout($with_message = null){
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        if($with_message){
            return redirect('/')->with('error', $with_message);
        }

        return redirect('/');
    }

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->hasRole("Guru Full Time") || Auth::user()->hasRole("Guru Part Time")){
                    return redirect()->intended('/tasks');
                } else if(Auth::user()->hasRole("TPA Full Time") || Auth::user()->hasRole("TPA Part Time")){
                    return redirect()->intended('/permits');
                } else if(Auth::user()->hasRole('Super Admin')){
                    return redirect()->intended('/user-managements');
                } else if(Auth::user()->hasRole('Admin')){
                    return $this->userLogout("There is something wrong with the role in your account, contact Super Admin");
                } else if(Auth::user()->hasRole('Wakasek')){
                    return redirect()->intended('/permits');
                } else {
                    return $this->userLogout("There is something wrong with the role in your account, contact Super Admin");
                }
            }
        }

        return $next($request);
    }
}
