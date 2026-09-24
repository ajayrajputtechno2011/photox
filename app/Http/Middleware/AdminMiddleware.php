<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->guest('/admin/login')->with('error', 'Please sign in to access the Admin Panel.');
        }

        if (Auth::user()->role !== 'admin') {
            Auth::logout();

            return redirect('/admin/login')->with('error', 'Access denied. Administrator privileges required.');
        }

        return $next($request);
    }
}
