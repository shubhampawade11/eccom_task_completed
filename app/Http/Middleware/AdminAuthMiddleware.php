<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminAuthMiddleware
{
 
    public function handle($request, Closure $next)
    {
       
        if (!Auth::guard('admin')->check()) {
           
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
