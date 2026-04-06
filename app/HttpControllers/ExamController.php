<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $query = Exam::where('user_id', Auth::id());
        $subjects = \App\Models\Subject::all();
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->filled('date_start')) {
            $query->where('exam_date', '>=', $request->date_start);
        }
        if ($request->filled('date_end')) {
            $query->where('exam_date', '<=', $request->date_end);
        }
        $exams = $query->latest()->get();
        return view('exams.index', compact('exams', 'subjects'));
    }
}