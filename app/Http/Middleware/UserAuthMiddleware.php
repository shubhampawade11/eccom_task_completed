<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class UserAuthMiddleware
{
   
    public function handle($request, Closure $next)
    {
      
        if (!Auth::check()) {
           
            return redirect()->route('user.login');
        }

        return $next($request);
    }
}
