<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information or password.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // If the password update form was submitted
        if ($request->has('update_password')) {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return back()->with('status', 'password-updated');
        }

        // If the profile photo removal was requested
        if ($request->has('remove_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
                $user->update(['profile_photo_path' => null]);
            }

            return back()->with('status', 'photo-removed');
        }

        // Otherwise, it's the profile information form
         $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->fill($request->only(['name', 'email']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos/users', 'public');
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }
}