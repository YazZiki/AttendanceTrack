<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamController extends Controller
{
    // Display list of exams (Dashboard)
    public function index(): View
    {
        $exams = Exam::with(['examType', 'course', 'section'])->latest()->get();
        return view('exams.index', compact('exams'));
    }

    // Show create form
    public function create(): View
    {
        return view('exams.create', [
            'examTypes' => ExamType::all(),
            'courses'   => Course::all(),
            'sections'  => Section::all(),
        ]);
    }

    // Store new exam (CRUD: Create)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'exam_type_id' => ['required', 'integer', 'exists:exam_types,id'],
            'course_id'    => ['required', 'integer', 'exists:courses,id'],
            'section_id'   => ['required', 'integer', 'exists:sections,id'],
            'exam_date'    => ['required', 'date'],
            'exam_time'    => ['required'],
            'duration'     => ['required', 'integer', 'min:1'],
            'max_grade'    => ['required', 'numeric', 'min:0'],
            'min_grade'    => ['required', 'numeric', 'min:0'],
            'room'         => ['nullable', 'string', 'max:255'],
        ]);

        $exam = Exam::create($validated);

        return redirect()->route('exams.show', $exam)
            ->with('success', 'Exam scheduled successfully.');
    }

    // Show single exam details with student grades (CRUD: Read)
    public function show(Exam $exam): View
    {
        $exam->load(['examType', 'course', 'section', 'grades.student']);
        return view('exams.show', compact('exam'));
    }

    // Show edit form
    public function edit(Exam $exam): View
    {
        return view('exams.edit', [
            'exam'      => $exam,
            'examTypes' => ExamType::all(),
            'courses'   => Course::all(),
            'sections'  => Section::all(),
        ]);
    }

    // Update exam (CRUD: Update)
    public function update(Request $request, Exam $exam): RedirectResponse
    {
        $validated = $request->validate([
            'exam_type_id' => ['required', 'integer', 'exists:exam_types,id'],
            'course_id'    => ['required', 'integer', 'exists:courses,id'],
            'section_id'   => ['required', 'integer', 'exists:sections,id'],
            'exam_date'    => ['required', 'date'],
            'exam_time'    => ['required'],
            'duration'     => ['required', 'integer', 'min:1'],
            'max_grade'    => ['required', 'numeric', 'min:0'],
            'min_grade'    => ['required', 'numeric', 'min:0'],
            'room'         => ['nullable', 'string', 'max:255'],
        ]);

        $exam->update($validated);

        return redirect()->route('exams.show', $exam)
            ->with('success', 'Exam updated successfully.');
    }

    // Delete exam (CRUD: Delete)
    public function destroy(Exam $exam): RedirectResponse
    {
        $exam->delete();

        return redirect()->route('exams.dashboard')
            ->with('success', 'Exam deleted successfully.');
    }
}