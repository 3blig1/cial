<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('teacher');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhereHas('teacher', function ($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
        }

        $courses = $query->latest()->paginate(10)->withQueryString();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('last_name')->get();
        return view('courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|in:A1,A2,B1,B2,C1',
            'teacher_id' => 'required|exists:teachers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Cours ajouté avec succès.');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $teachers = Teacher::orderBy('last_name')->get();
        return view('courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|in:A1,A2,B1,B2,C1',
            'teacher_id' => 'required|exists:teachers,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Cours supprimé avec succès.');
    }
}
