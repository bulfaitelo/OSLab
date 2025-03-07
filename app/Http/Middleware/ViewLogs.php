<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewLogs
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->can('relatorio_sistema_log')) {
            return $next($request);
        }

        abort(403, 'User does not have the right permissions.');
    }
}
