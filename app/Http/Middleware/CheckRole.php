<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleRoutes = [
            2 => "userDashboard",
            3 => "cooks",
        ];

        $userRole = Auth::user()->role_id;

        if (isset($roleRoutes[$userRole])) {
            return redirect()->route($roleRoutes[$userRole]);
        }


        return $next($request);
    }
}
