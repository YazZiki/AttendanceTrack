<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with('sections')->latest()->get();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'university_id' => ['required', 'string', 'max:255', 'unique:students,university_id'],
            'national_id' => ['required', 'string', 'max:255', 'unique:students,national_id'],
            'major' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
        ]);

        $student = Student::create($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load('sections');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'university_id' => [
                'required',
                'string',
                'max:255',
                'unique:students,university_id,'.$student->id,
            ],
            'national_id' => [
                'required',
                'string',
                'max:255',
                'unique:students,national_id,'.$student->id,
            ],
            'major' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
