<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }
    public function create()
    {
        return view('subjects.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        Subject::create($validated);
        return redirect()->route('subjects.index')->with('success', 'Matière ajoutée.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $subject->update($validated);
        return redirect()->route('subjects.index')->with('success', 'Matière modifiée.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Matière supprimée.');
    }
}
