<?php

namespace App\Http\Controllers;

use App\Models\PendingStudent;
use App\Models\Student;
use Illuminate\Http\Request;

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
        $student = Student::create($pendingStudent->toArray());
        $pendingStudent->delete();
        return redirect()->route('pending-students.index')->with('success', 'Étudiant activé avec succès.');
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
