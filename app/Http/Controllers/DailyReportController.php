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

        $applyFilters = function ($query) use ($request) {
            return $query
                ->when($request->filled('report_date'), fn ($q) => $q->whereDate('report_date', $request->input('report_date')))
                ->when($request->filled('author_id'), fn ($q) => $q->where('user_id', $request->input('author_id')));
        };

        // Bypass the school global scope so cross-school delegated permissions can work without switching the active school.
        $showWorkspace = false;
        $workspaceQuery = null;

        if ($user->isAdmin()) {
            $myReportsQuery = DailyReport::withoutGlobalScope('school')->with('author')
                ->where('school_id', session('school_id'));
        } elseif ($user->isSecretary() && $user->hasPermission('manage_secretary_all_reports')) {
            $myReportsQuery = DailyReport::withoutGlobalScope('school')->with('author')->where('user_id', $user->id);

            $workspaceQuery = DailyReport::withoutGlobalScope('school')->with('author')
                ->where('user_id', '!=', $user->id)
                ->whereHas('author', fn ($authorQuery) => $authorQuery->where('role', 'secretary'));

            $showWorkspace = true;
        } else {
            $myReportsQuery = DailyReport::withoutGlobalScope('school')->with('author')
                ->where('user_id', $user->id)
                ->where('school_id', session('school_id'));
        }

        $reports = $applyFilters($myReportsQuery)
            ->latest()
            ->paginate(10, ['*'], 'reports_page')
            ->withQueryString();

        $workspaceReports = $showWorkspace
            ? $applyFilters($workspaceQuery)->latest()->paginate(10, ['*'], 'workspace_page')->withQueryString()
            : null;

        $authors = User::query()
            ->whereHas('reports')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('reports.index', compact('reports', 'workspaceReports', 'showWorkspace', 'authors'));
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

    public function show($report)
    {
        $report = DailyReport::withoutGlobalScope('school')->with('author')->findOrFail($report);

        if (! Auth::user()->canManageReport($report)) {
            abort(403, "Vous n'avez pas la permission de consulter ce rapport.");
        }

        return view('reports.show', compact('report'));
    }

    public function edit($report)
    {
        $user = Auth::user();
        $report = DailyReport::withoutGlobalScope('school')->findOrFail($report);

        if (! $user->canManageReport($report)) {
            abort(403, "Vous n'avez pas la permission de modifier ce rapport.");
        }

        // Une secrétaire ne peut modifier un rapport que le jour de sa création.
        if ($user->isSecretary() && !now()->isSameDay($report->created_at)) {
            abort(403, 'Les rapports ne peuvent être modifiés que le jour de leur création.');
        }

        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $report)
    {
        $user = Auth::user();
        $report = DailyReport::withoutGlobalScope('school')->findOrFail($report);

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

    public function destroy($report)
    {
        $user = Auth::user();
        $report = DailyReport::withoutGlobalScope('school')->findOrFail($report);

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