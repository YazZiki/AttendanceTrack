<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function index(): View
    {
        $sections = Section::with(['course', 'students'])->latest()->get();

        return view('sections.index', compact('sections'));
    }

    public function create(): View
    {
        return view('sections.create', ['courses' => Course::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'section_name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);

        $section = Section::create($validated);

        return redirect()->route('sections.show', $section)
            ->with('success', 'Section created successfully.');
    }

    public function show(Section $section): View
    {
        $section->load(['course', 'students']);

        return view('sections.show', compact('section'));
    }

    public function edit(Section $section): View
    {
        return view('sections.edit', [
            'section' => $section,
            'courses' => Course::all(),
        ]);
    }

    public function update(Request $request, Section $section): RedirectResponse
    {
        $validated = $request->validate([
            'section_name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);

        $section->update($validated);

        return redirect()->route('sections.show', $section)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();

        return redirect()->route('sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
