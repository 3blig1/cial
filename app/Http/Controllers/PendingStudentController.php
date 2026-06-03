<?php

namespace App\Http\Controllers;

use App\Models\PendingStudent;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
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

        $schoolId = $pendingStudent->school_id;

        if (! $schoolId || ! School::whereKey($schoolId)->exists()) {
            return redirect()
                ->route('pending-students.index')
                ->with('error', 'Activation impossible: aucune ecole valide n\'est definie pour cet etudiant en attente.');
        }

        try {
            $result = DB::transaction(function () use ($pendingStudent, $schoolId, $normalizedEmail): string {
                $existingStudent = Student::where('school_id', $schoolId)
                    ->where('email', $normalizedEmail)
                    ->first();

                if ($existingStudent) {
                    if (! $pendingStudent->delete()) {
                        throw new \RuntimeException('Suppression pending student echouee.');
                    }

                    return 'already_exists';
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

                $user->schools()->syncWithoutDetaching([$schoolId]);

                $studentData = $pendingStudent->toArray();
                $studentData['email'] = $normalizedEmail;
                $studentData['school_id'] = $schoolId;
                $studentData['user_id'] = $user->id;

                Student::create($studentData);

                if (! $pendingStudent->delete()) {
                    throw new \RuntimeException('Suppression pending student echouee.');
                }

                return 'created';
            });

            if ($result === 'already_exists') {
                return redirect()
                    ->route('pending-students.index')
                    ->with('success', 'Cet etudiant existe deja dans cette ecole. Entree en attente supprimee.');
            }

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
                $existingStudent = Student::where('school_id', $schoolId)
                    ->where('email', $normalizedEmail)
                    ->first();

                if ($existingStudent) {
                    $pendingStudent->delete();

                    return redirect()
                        ->route('pending-students.index')
                        ->with('success', 'Cet etudiant est deja active dans cette ecole. Entree en attente supprimee.');
                }

                $errorMessage = $exception->getMessage();

                if (str_contains($errorMessage, 'students_school_id_email_unique')) {
                    $message = 'Activation impossible: un eleve avec cet email existe deja dans cette ecole.';
                } elseif (str_contains($errorMessage, 'users_email_unique')) {
                    $message = 'Activation impossible: un compte utilisateur avec cet email existe deja.';
                } elseif (str_contains($errorMessage, 'school_user_school_id_user_id_unique')) {
                    $message = 'Activation impossible: cet utilisateur est deja rattache a cette ecole.';
                } else {
                    $message = 'Activation impossible: un doublon a ete detecte pendant l\'activation.';
                }
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
