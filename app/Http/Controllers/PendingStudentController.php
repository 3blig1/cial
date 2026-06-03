<?php

namespace App\Http\Controllers;

use App\Models\PendingStudent;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PendingStudentController extends Controller
{
    // Affiche la liste d'attente
    public function index()
    {
        $schoolId = session('school_id');

        $pendingStudents = PendingStudent::query()
            ->when(
                $schoolId,
                fn ($query) => $query->where('school_id', $schoolId),
                fn ($query) => $query->whereRaw('1 = 0')
            )
            ->latest()
            ->get();

        return view('pending_students.index', compact('pendingStudents'));
    }

    // Active un étudiant (transfert vers students)
    public function activate(PendingStudent $pendingStudent)
    {
        $normalizedEmail = strtolower(trim($pendingStudent->email));

        $defaultSchool = School::firstOrCreate(
            ['code' => 'default'],
            ['name' => 'École Principale', 'is_active' => true]
        );

        $schoolId = $pendingStudent->school_id;

        if (! $schoolId || ! School::whereKey($schoolId)->exists()) {
            $schoolId = $defaultSchool->id;
        }

        if (Student::where('school_id', $schoolId)->where('email', $normalizedEmail)->exists()) {
            $pendingStudent->delete();

            return redirect()
                ->route('pending-students.index')
                ->with('success', 'Cet etudiant existe deja dans cette ecole. Entree en attente supprimee.');
        }

        $user = User::firstOrCreate(
            ['email' => $normalizedEmail],
            [
                'name' => trim($pendingStudent->first_name . ' ' . $pendingStudent->last_name),
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        if ($user->role !== 'student') {
            $user->update(['role' => 'student']);
        }

        $studentData = $pendingStudent->toArray();
        $studentData['email'] = $normalizedEmail;
        $studentData['school_id'] = $schoolId;
        $studentData['user_id'] = $user->id;

        try {
            DB::transaction(function () use ($studentData, $pendingStudent, $user, $schoolId): void {
                $user->schools()->syncWithoutDetaching([$schoolId]);

                Student::create($studentData);

                if (! $pendingStudent->delete()) {
                    throw new \RuntimeException('Suppression pending student echouee.');
                }
            });

            return redirect()->route('pending-students.index')->with('success', 'Étudiant activé avec succès.');
        } catch (QueryException $exception) {
            Log::warning('Activation etudiant en attente echouee.', [
                'pending_student_id' => $pendingStudent->id,
                'email' => $pendingStudent->email,
                'error' => $exception->getMessage(),
            ]);

            $message = 'Activation impossible pour le moment. Verifiez les donnees puis reessayez.';

            if (($exception->errorInfo[1] ?? null) === 1054) {
                $message = 'Activation impossible: base de donnees non a jour (colonne manquante). Lancez les migrations.';
            } elseif (($exception->errorInfo[1] ?? null) === 1062) {
                $message = 'Activation impossible: un eleve avec cet email existe deja dans cette ecole.';
            } elseif (($exception->errorInfo[1] ?? null) === 1452) {
                $message = 'Activation impossible: reference de donnees invalide (ecole/utilisateur).';
            }

            return redirect()
                ->route('pending-students.index')
                ->with('error', $message);
        } catch (\Throwable $exception) {
            Log::warning('Activation etudiant en attente echouee.', [
                'pending_student_id' => $pendingStudent->id,
                'email' => $pendingStudent->email,
                'error' => $exception->getMessage(),
            ]);

            return redirect()
                ->route('pending-students.index')
                ->with('error', 'Activation impossible pour le moment. Verifiez les donnees puis reessayez.');
        }
    }

    // Supprime un étudiant en attente
    public function destroy(PendingStudent $pendingStudent)
    {
        $pendingStudent->delete();
        return redirect()->route('pending-students.index')->with('success', 'Étudiant supprimé de la liste d\'attente.');
    }

    // Génère et télécharge la fiche d'inscription PDF pour un étudiant en attente
    public function downloadRegistrationForm(PendingStudent $pendingStudent)
    {
        $logoPath = public_path('logo/Logo_icone.png');
        $logoSrc = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,' . $logoData;
        }

        // Pas de photo de profil pour les pending students par défaut
        $studentPhotoSrc = '';

        $data = [
            'student' => $pendingStudent,
            'date' => now()->format('d/m/Y'),
            'logoSrc' => $logoSrc,
            'studentPhotoSrc' => $studentPhotoSrc,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('students.registration-form-pdf', $data);
        $studentName = $pendingStudent->first_name . ' ' . $pendingStudent->last_name;
        return $pdf->stream('fiche-inscription-attente-' . $studentName . '.pdf');
    }
}
