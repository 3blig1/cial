<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherObserver
{
    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {
        User::create([
            'name' => $teacher->first_name . ' ' . $teacher->last_name,
            'email' => $teacher->email,
            'password' => Hash::make('password'), // Mot de passe par défaut.
            'role' => 'teacher',
        ]);
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        if ($teacher->isDirty('email')) {
            $user = User::where('email', $teacher->getOriginal('email'))->first();
            if ($user) {
                $user->update(['email' => $teacher->email]);
            }
        }
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        $user = User::where('email', $teacher->getOriginal('email'))->first();
        if ($user) {
            $user->delete();
        }
    }
}


