<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        User::create([
            'name' => $student->first_name . ' ' . $student->last_name,
            'email' => $student->email,
            'password' => Hash::make('password'), // Mot de passe par défaut. À changer en production !
            'role' => 'student',
        ]);
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        if ($student->isDirty('email')) {
            $user = User::where('email', $student->getOriginal('email'))->first();
            if ($user) {
                $user->update(['email' => $student->email]);
            }
        }
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        // Utilise getOriginal pour retrouver l'utilisateur même si l'email a été modifié juste avant la suppression
        $user = User::where('email', $student->getOriginal('email'))->first();
        if ($user) {
            $user->delete();
        }
    }
}