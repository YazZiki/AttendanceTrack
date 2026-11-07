<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function index(): View
    {
        $sections = Section::with(['course', 'instructor', 'students'])->latest()->get();

        return view('sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('sections.create', [
            'courses' => Course::all(),
            'instructors' => User::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'section_name' => ['required', 'string', 'max:50'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'instructor_id' => ['required', 'integer', 'exists:users,id'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        $validated['semester_id'] = Course::findOrFail($validated['course_id'])->semester_id;

        $section = Section::create($validated);

        return redirect()->route('students.sections.show', $section)
            ->with('success', 'Section created successfully.');
    }

    public function show(Section $section): View
    {
        $section->load(['course', 'instructor', 'students']);

        return view('sections.show', compact('section'));
    }

    public function edit(Section $section): View
    {
        return view('sections.edit', [
            'section' => $section,
            'courses' => Course::all(),
            'instructors' => User::all(),
        ]);
    }

    public function update(Request $request, Section $section): RedirectResponse
    {
        $validated = $request->validate([
            'section_name' => ['required', 'string', 'max:50'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'instructor_id' => ['required', 'integer', 'exists:users,id'],
            'capacity' => ['required', 'integer', 'min:1'],
        ]);

        $validated['semester_id'] = Course::findOrFail($validated['course_id'])->semester_id;

        $section->update($validated);

        return redirect()->route('students.sections.show', $section)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();

        return redirect()->route('students.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
