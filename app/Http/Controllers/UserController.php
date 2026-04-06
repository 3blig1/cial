<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()
            ->with('schools')
            ->where('id', '!=', Auth::id())
            ->where('name', '!=', 'Admin'); // On exclut l'utilisateur "Admin"

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();
        $roles = ['admin', 'secretary', 'teacher', 'student'];
        $schools = School::where('is_active', true)->orderBy('name')->get();

        return view('users.index', compact('users', 'roles', 'schools'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Un admin ne peut pas changer son propre rôle via cette interface
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas changer votre propre rôle.');
        }

        // On ne peut pas changer le rôle de l'utilisateur "Admin" principal
        if ($user->name === 'Admin') {
            return back()->with('error', 'Le rôle de l\'administrateur principal ne peut pas être modifié.');
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'secretary', 'teacher', 'student'])],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Le rôle de ' . $user->name . ' a été mis à jour.');
    }

    public function updateSchools(Request $request, User $user)
    {
        if ($user->name === 'Admin') {
            return back()->with('error', 'Les écoles de l\'administrateur principal ne peuvent pas être modifiées ici.');
        }

        $validated = $request->validate([
            'school_ids' => ['required', 'array', 'min:1'],
            'school_ids.*' => ['integer', 'exists:schools,id'],
        ]);

        $user->schools()->sync($validated['school_ids']);

        return back()->with('success', 'Les accès école de ' . $user->name . ' ont été mis à jour.');
    }
}
