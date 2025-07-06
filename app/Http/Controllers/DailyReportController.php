<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    public function index()
    {
        $reports = DailyReport::with('author')->latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'content' => 'required|string',
        ]);

        Auth::user()->reports()->create($validated);

        return redirect()->route('reports.index')->with('success', 'Rapport créé avec succès.');
    }

    public function show(DailyReport $report)
    {
        $report->load('author');
        return view('reports.show', compact('report'));
    }

    public function edit(DailyReport $report)
    {
        // Un utilisateur doit être l'auteur du rapport pour le modifier (sauf si c'est un admin)
        if (! (Auth::user()->isAdmin() || Auth::id() === $report->user_id)) {
            abort(403, "Vous n'avez pas la permission de modifier ce rapport.");
        }

        // Une secrétaire ne peut modifier un rapport que le jour de sa création.
        if (Auth::user()->isSecretary() && !now()->isSameDay($report->created_at)) {
            abort(403, 'Les rapports ne peuvent être modifiés que le jour de leur création.');
        }

        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, DailyReport $report)
    {
        // Mêmes vérifications de permission que pour la méthode edit
        if (! (Auth::user()->isAdmin() || Auth::id() === $report->user_id)) {
            abort(403, "Vous n'avez pas la permission de modifier ce rapport.");
        }

        if (Auth::user()->isSecretary() && !now()->isSameDay($report->created_at)) {
            abort(403, 'Les rapports ne peuvent être modifiés que le jour de leur création.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'report_date' => 'required|date',
            'content' => 'required|string',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Rapport mis à jour avec succès.');
    }

    public function destroy(DailyReport $report)
    {
        if (! Auth::user()->isAdmin()) {
            abort(403);
        }
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Rapport supprimé avec succès.');
    }
}