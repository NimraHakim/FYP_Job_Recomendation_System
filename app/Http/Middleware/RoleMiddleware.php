<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     if (!auth()->check()) {
            return redirect()->route('account.login');
        }

        if (auth()->user()->user_role != $role) {
            abort(403); // unauthorized access
        }
        return $next($request);
    }
}
