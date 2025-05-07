<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class CheckFinance
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role !== 'finance_manager') {
            abort(403, 'ليس لديك صلاحية الوصول');
        }

        return $next($request);
    }
}
