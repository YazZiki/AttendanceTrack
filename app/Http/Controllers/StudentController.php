<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::with(['department', 'sections'])->latest()->get();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create', [
            'departments' => Department::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'     => ['required', 'string', 'max:100'],
            'university_id' => ['required', 'string', 'max:20', 'unique:students,university_id'],
            'national_id'   => ['required', 'string', 'max:20', 'unique:students,national_id'],
            'birth_date'    => ['required', 'date'],
            'phone'         => ['required', 'string', 'max:15'],
            'email'         => ['nullable', 'email', 'max:100'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'academic_year' => ['required', 'in:1,2,3,4'],
        ]);

        $student = Student::create($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student): View
    {
        $student->load(['department', 'sections']);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', [
            'student'     => $student,
            'departments' => Department::all(),
        ]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'     => ['required', 'string', 'max:100'],
            'university_id' => ['required', 'string', 'max:20', 'unique:students,university_id,'.$student->id],
            'national_id'   => ['required', 'string', 'max:20', 'unique:students,national_id,'.$student->id],
            'birth_date'    => ['required', 'date'],
            'phone'         => ['required', 'string', 'max:15'],
            'email'         => ['nullable', 'email', 'max:100'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'academic_year' => ['required', 'in:1,2,3,4'],
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.dashboard')
            ->with('success', 'Student deleted successfully.');
    }
}