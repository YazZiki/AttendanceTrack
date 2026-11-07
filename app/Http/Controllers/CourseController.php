<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::with(['department', 'instructor', 'semester'])->latest()->get();

        return view('courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('courses.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $course = Course::create($this->validatedData($request));

        return redirect()->route('courses.show', $course)
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load(['department', 'instructor', 'semester', 'sections', 'prerequisite']);

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', array_merge(
            ['course' => $course],
            $this->formData(),
        ));
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $course->update($this->validatedData($request, $course));

        return redirect()->route('courses.show', $course)
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(): array
    {
        return [
            'departments' => Department::all(),
            'instructors' => User::whereHas('role', function ($query) {
                $query->whereIn('role_name', ['manager', 'employee']);
            })->get(),
            'semesters' => Semester::all(),
            'prerequisites' => Course::query()->orderBy('course_name')->get(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?Course $course = null): array
    {
        $uniqueCourseCode = 'unique:courses,course_code';

        if ($course !== null) {
            $uniqueCourseCode .= ','.$course->id;
        }

        return $request->validate([
            'course_name' => ['required', 'string', 'max:100'],
            'course_code' => ['required', 'string', 'max:20', $uniqueCourseCode],
            'credit_hours' => ['required', 'integer', 'between:1,6'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'instructor_id' => ['required', 'integer', 'exists:users,id'],
            'semester_id' => ['required', 'integer', 'exists:semesters,id'],
            'academic_year' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'prerequisite_id' => ['nullable', 'integer', 'exists:courses,id'],
            'status' => ['required', 'in:active,inactive'],
        ]);
    }
}
