<?php
namespace App\Http\Controllers;

use App\Models\PendingUser;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendingUserController extends Controller
{
    // Affiche la liste d'attente
    public function index()
    {
        $pendingUsers = PendingUser::all();
        return view('pending_users.index', compact('pendingUsers'));
    }

    // Active un utilisateur (transfert vers users)
    public function activate(PendingUser $pendingUser)
    {
        $defaultSchool = School::firstOrCreate(
            ['code' => 'default'],
            ['name' => 'École Principale', 'is_active' => true]
        );

        $schoolId = $pendingUser->school_id ?: $defaultSchool->id;

        $password = $pendingUser->role === 'student'
            ? Hash::make('password')
            : $pendingUser->password;

        $user = User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $password,
            'role' => $pendingUser->role,
        ]);

        $user->schools()->syncWithoutDetaching([$schoolId]);

        $pendingUser->delete();
        return redirect()->route('pending-users.index')->with('success', 'Utilisateur activé.');
    }

    // Désactive (supprime) un utilisateur en attente
    public function destroy(PendingUser $pendingUser)
    {
        $pendingUser->delete();
        return redirect()->route('pending-users.index')->with('success', 'Utilisateur supprimé.');
    }
}
