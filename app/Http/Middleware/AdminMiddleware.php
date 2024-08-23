<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === User::ROLE_SUPERADMIN) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role === User::ROLE_ADMIN) {
            return $next($request);
        }
        // return $next($request);
        return response()->json([
            'message' => 'Unauthenticated - admin'
        ], 401);
    }
}
