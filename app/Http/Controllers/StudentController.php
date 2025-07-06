<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    public function downloadRegistrationForm(Student $student)
    {
        // Chemin vers le logo. Assurez-vous que ce fichier existe.
        // Par exemple, dans votre répertoire `public`.
        $logoPath = public_path('logo/Logo_icone.png');
        $logoSrc = '';

        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,' . $logoData;
        }

        // Ajout de la photo de profil de l'étudiant
        $studentPhotoSrc = '';
        if ($student->profile_photo_path && Storage::disk('public')->exists($student->profile_photo_path)) {
            $photoContents = Storage::disk('public')->get($student->profile_photo_path);
            $photoData = base64_encode($photoContents);
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($photoContents);
            $studentPhotoSrc = 'data:' . $mimeType . ';base64,' . $photoData;
        }

        $data = [
            'student' => $student,
            'date' => now()->format('d/m/Y'),
            'logoSrc' => $logoSrc,
            'studentPhotoSrc' => $studentPhotoSrc,
        ];

        $pdf = Pdf::loadView('students.registration-form-pdf', $data);
        $studentName = $student->first_name . ' ' . $student->last_name;

        // Vous pouvez forcer le téléchargement du fichier
       // return $pdf->download('fiche-inscription-'.$studentName.'.pdf');

        // Ou l'afficher directement dans le navigateur
         return $pdf->stream('fiche-inscription-'.$studentName.'.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Student::query();

        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'language_level' => 'required|in:A1,A2,B1,B2,C1',
            'profile_photo' => 'nullable|image|max:2048', // 2MB Max
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_email' => 'nullable|email|max:255',
        ]);

        $studentData = $validated;

        if ($request->hasFile('profile_photo')) {
            $studentData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        Student::create($studentData);

        return redirect()->route('students.index')->with('success', 'Élève ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'language_level' => 'required|in:A1,A2,B1,B2,C1',
            'profile_photo' => 'nullable|image|max:2048', // 2MB Max
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
            'emergency_contact_email' => 'nullable|email|max:255',
        ]);

        $studentData = $validated;

        if ($request->hasFile('profile_photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($student->profile_photo_path) {
                Storage::disk('public')->delete($student->profile_photo_path);
            }
            $studentData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $student->update($studentData);

        return redirect()->route('students.index')->with('success', 'Élève mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // Supprimer la photo de profil si elle existe
        if ($student->profile_photo_path) {
            Storage::disk('public')->delete($student->profile_photo_path);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Élève supprimé avec succès.');
    }
}
