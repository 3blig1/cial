<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PendingUser;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendingRegisterController extends Controller
{
    public function show()
    {
        $schools = School::where('is_active', true)->orderBy('name')->get();

        return view('auth.pending_register', compact('schools'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pending_users,email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'school_id' => 'required|integer|exists:schools,id',
        ]);

        $school = School::where('id', $validated['school_id'])->where('is_active', true)->first();

        if (! $school) {
            return back()->withErrors(['school_id' => 'École invalide ou inactive.'])->withInput();
        }

        $pending = PendingUser::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'school_id' => $school->id,
        ]);
        return redirect()->route('login')->with('success', 'Votre demande a été enregistrée. Vous serez contacté après validation.');
    }
}
