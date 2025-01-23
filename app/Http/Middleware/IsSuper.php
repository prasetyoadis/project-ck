<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'kaadmin') {
            abort(403, 'Your account is not Super Admin.');
        }
        return $next($request);
    }
}
