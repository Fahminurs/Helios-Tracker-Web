<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if (Auth::check()) {
                // If user is logged in but wrong role, redirect to appropriate dashboard
                return redirect()->route(Auth::user()->role === 'admin' ? 'dashboard' : 'main');
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
} 