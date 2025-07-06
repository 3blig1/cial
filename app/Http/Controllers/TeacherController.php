<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $teachers = $query->latest()->paginate(10)->withQueryString();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:255',
            'specialty' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $teacherData = $validated;

        if ($request->hasFile('profile_photo')) {
            $teacherData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos/teachers', 'public');
        }

        Teacher::create($teacherData);

        return redirect()->route('teachers.index')->with('success', 'Enseignant ajouté avec succès.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('courses');
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:255',
            'specialty' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $teacherData = $validated;

        if ($request->hasFile('profile_photo')) {
            if ($teacher->profile_photo_path) {
                Storage::disk('public')->delete($teacher->profile_photo_path);
            }
            $teacherData['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos/teachers', 'public');
        }

        $teacher->update($teacherData);

        return redirect()->route('teachers.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->profile_photo_path) {
            Storage::disk('public')->delete($teacher->profile_photo_path);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Enseignant supprimé avec succès.');
    }
}
