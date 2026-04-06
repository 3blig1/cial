<?php

namespace App\Http\Middleware;

use App\Models\School;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSchoolContext
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $schoolId = $request->session()->get('school_id');
        $isActiveSchool = $schoolId && School::whereKey($schoolId)->where('is_active', true)->exists();

        if (! $schoolId || ! $isActiveSchool) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Session invalide: école inactive ou introuvable.');
        }

        if (! $request->user()->isAdmin() && ! $request->user()->schools()->where('schools.id', $schoolId)->exists()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Session invalide: aucune école autorisée sélectionnée.');
        }

        return $next($request);
    }
}
