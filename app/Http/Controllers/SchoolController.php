<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $query = School::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $schools = $query->latest()->paginate(15)->withQueryString();

        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schools,name'],
            'code' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:schools,code'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        School::create([
            'name' => $validated['name'],
            'code' => strtolower($validated['code']),
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('schools.index')->with('success', 'École créée avec succès.');
    }

    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:schools,name,' . $school->id],
            'code' => ['required', 'string', 'max:100', 'alpha_dash', 'unique:schools,code,' . $school->id],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $school->update([
            'name' => $validated['name'],
            'code' => strtolower($validated['code']),
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('schools.index')->with('success', 'École mise à jour avec succès.');
    }

    public function destroy(School $school)
    {
        if ($school->users()->exists()) {
            return back()->with('error', 'Impossible de supprimer cette école car des utilisateurs y sont rattachés.');
        }

        $school->delete();

        return redirect()->route('schools.index')->with('success', 'École supprimée avec succès.');
    }
}
