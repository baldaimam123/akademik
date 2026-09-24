<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = session('user');

        if (!$user) {
            return redirect('/login');
        }

        if (!in_array($user->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}

// <?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;

// class RoleMiddleware
// {
//     public function handle(Request $request, Closure $next, ...$roles)
// {
//     $user = session('user');

//     dd([
//         'user' => $user,
//         'role' => $user?->role,
//         'roles_di_route' => $roles,
//     ]);

//     if (!$user) {
//         return redirect('/login');
//     }

//     if (!in_array($user->role, $roles)) {
//         abort(403);
//     }

//     return $next($request);
// }
// }