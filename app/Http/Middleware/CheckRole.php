<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$checks): Response
    {
        if (! auth()->check()) {
            abort(403, 'ACTION NON AUTORISÉE.');
        }

        $roles = [];
        $permissions = [];

        foreach ($checks as $check) {
            if (str_starts_with($check, 'permission:')) {
                $permissions[] = substr($check, strlen('permission:'));
                continue;
            }

            $roles[] = $check;
        }

        $user = $request->user();
        $hasRequiredRole = $roles !== [] && $user->hasAnyRole($roles);
        $hasRequiredPermission = $permissions !== [] && $user->hasAnyPermission($permissions);

        if (! $hasRequiredRole && ! $hasRequiredPermission) {
            abort(403, 'ACTION NON AUTORISÉE.');
        }

        return $next($request);
    }
}
