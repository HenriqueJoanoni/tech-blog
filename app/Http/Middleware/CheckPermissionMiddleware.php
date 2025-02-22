<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user || $user->permission_id == config('app.viewer_access')) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}

