<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamGrade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExamGradesExport;

class ExamController extends Controller
{
    // Affiche la liste des examens de l'enseignant
    public function index(Request $request)
    {
        $query = Exam::where('user_id', Auth::id());
        $subjects = \App\Models\Subject::all();
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        $exams = $query->latest()->get();
        return view('exams.index', compact('exams', 'subjects'));
    }

    // Formulaire de création d'examen
    public function create()
    {
        return view('exams.create');
    }

    // Enregistre un nouvel examen
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exam_date' => 'required|date',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $validated['user_id'] = Auth::id();
        $exam = Exam::create($validated);
        return redirect()->route('exams.grades', $exam)->with('success', 'Examen créé.');
    }

    // Formulaire de saisie des notes pour un examen
    public function grades(Exam $exam)
    {
        // Sélectionner les élèves inscrits à un cours correspondant à la matière de l'examen
        $students = collect();
        if ($exam->subject_id) {
            $courses = \App\Models\Course::where('subject_id', $exam->subject_id)->get();
            foreach ($courses as $course) {
                $students = $students->merge($course->students);
            }
            $students = $students->unique('id');
        }
        $grades = $exam->grades()->get()->keyBy('student_id');
        return view('exams.grades', compact('exam', 'students', 'grades'));
    }

    // Enregistre les notes des élèves pour un examen
    public function saveGrades(Request $request, Exam $exam)
    {
        foreach ($request->input('grades', []) as $student_id => $data) {
            ExamGrade::updateOrCreate(
                ['exam_id' => $exam->id, 'student_id' => $student_id],
                ['grade' => $data['grade'], 'comment' => $data['comment'] ?? null]
            );
        }
        return redirect()->route('exams.index')->with('success', 'Notes enregistrées.');
    }

    // Formulaire d'édition d'examen
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    // Met à jour un examen
    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'exam_date' => 'required|date',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $exam->update($validated);
        return redirect()->route('exams.index')->with('success', 'Examen modifié.');
    }


    // Supprime un examen
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Examen supprimé.');
    }



    // Exporter les notes d'un examen vers Excel
    public function exportGrades(Exam $exam)
    {
        $grades = $exam->grades()->with('student')->get();
        $exportData = $grades->map(function($grade) {
            return [
                'Élève' => $grade->student->name,
                'Note' => $grade->grade,
                'Commentaire' => $grade->comment,
            ];
        });
        return Excel::download(new ExamGradesExport($exportData), 'notes_examen_' . $exam->id . '.xlsx');
    }
}
