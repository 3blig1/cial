<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $reports = DailyReport::with('author')
            ->when(! $user->isAdmin(), function ($query) use ($user) {
                $query->where(function ($subQuery) use ($user) {
                    $subQuery->where('user_id', $user->id);

                    if ($user->isSecretary() && $user->hasPermission('manage_secretary_reports')) {
                        $subQuery->orWhereHas('author', fn ($authorQuery) => $authorQuery->where('role', 'secretary'));
                    }

                    if ($user->isTeacher() && $user->hasPermission('manage_teacher_reports')) {
                        $subQuery->orWhereHas('author', fn ($authorQuery) => $authorQuery->where('role', 'teacher'));
                    }
                });
            })
            ->when($request->filled('report_date'), function ($query) use ($request) {
                $query->whereDate('report_date', $request->input('report_date'));
            })
            ->when($request->filled('author_id'), function ($query) use ($request) {
                $query->where('user_id', $request->input('author_id'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $authors = User::query()
            ->whereHas('reports')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('reports.index', compact('reports', 'authors'));
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
        if (! Auth::user()->canManageReport($report)) {
            abort(403, "Vous n'avez pas la permission de consulter ce rapport.");
        }

        $report->load('author');
        return view('reports.show', compact('report'));
    }

    public function edit(DailyReport $report)
    {
        $user = Auth::user();

        if (! $user->canManageReport($report)) {
            abort(403, "Vous n'avez pas la permission de modifier ce rapport.");
        }

        // Une secrétaire ne peut modifier un rapport que le jour de sa création.
        if ($user->isSecretary() && !now()->isSameDay($report->created_at)) {
            abort(403, 'Les rapports ne peuvent être modifiés que le jour de leur création.');
        }

        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, DailyReport $report)
    {
        $user = Auth::user();

        if (! $user->canManageReport($report)) {
            abort(403, "Vous n'avez pas la permission de modifier ce rapport.");
        }

        if ($user->isSecretary() && !now()->isSameDay($report->created_at)) {
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
        $user = Auth::user();

        if (! $user->isAdmin() && ! $user->hasPermission('delete_reports')) {
            abort(403);
        }

        if (! $user->isAdmin() && Auth::id() !== $report->user_id) {
            abort(403, "Vous n'avez pas la permission de supprimer ce rapport.");
        }

        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Rapport supprimé avec succès.');
    }
}