<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // Exclure l'administrateur connecté pour éviter un auto-verrouillage
        $users = User::where('id', '!=', Auth::id())->latest()->paginate(15);
        $roles = ['admin', 'secretary', 'teacher', 'student'];

        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        // Un admin ne peut pas changer son propre rôle via cette interface
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas changer votre propre rôle.');
        }

        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'secretary', 'teacher', 'student'])],
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Le rôle de ' . $user->name . ' a été mis à jour.');
    }
}
